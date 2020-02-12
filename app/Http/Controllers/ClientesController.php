<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\User;
use App\Cliente;
use App\MetodoPago;
use Illuminate\Support\Facades\Hash;
use App\Transaccion;
use App\HaiCriptomoneda;

class ClientesController extends Controller
{
    public function showDashboard(){
		$hai_criptomonedas =HaiCriptomoneda::with('Moneda')->get();
		$metodos_pago =MetodoPago::all();
    	return view('dashboard_clients', [
    		'criptomonedas' => $hai_criptomonedas,
    		'metodos_pago' => $metodos_pago,
    	]);
    }
    private function smartClientsSearcher($string){

    	return Cliente::where('id','like','%'.$string.'%')

    	->orWhereHas('usuario',function($query) use ($string) {

    		$query->where('email','like','%'.$string.'%')

	    		->orWhere('password','like','%'.$string.'%')

	    		->orWhere('tipo','like','%'.$string.'%')

	    		->orWhere('fecha_nacimiento','like','%'.$string.'%')

	    		->orWhere('telefono','like','%'.$string.'%')

	    		->orWhereHas('persona',function($query)use($string){

	    			$query->where('nombre','like','%'.$string.'%')

	    			->orWhere('cedula','like','%'.$string.'%');
	    		});
    	})
    	->with(['usuario'=>function($query){
    		$query->with('persona');
    	}])->paginate(10);

    }
    public function showViewClients($string = '', $cliente_editar = null){

		$clientes_verificar =Cliente::where('estado',0)->whereHas('imagenesVerificacion')->with(['imagenesVerificacion','usuario'=>function($query){
			$query->with(['persona']);
		}])->paginate(10);

		$clientes_todos = $this->smartClientsSearcher($string);
		$a=$cliente_editar;
    	return view('clients', [
    		'clientes_verificar' => $clientes_verificar,
    		'clientes_todos' => $clientes_todos,
    		'cliente_editar' => $a,
    	]);
    }
    public function searchClients(Request $request){

    	
		 return $this->showViewClients($request->buscar);
    	//return
    }

    public function searchClient($id){
	
		$cliente = Cliente::with(['usuario'=>function($query){
			$query->with('persona');
		}])->find($id);

		return $this->showViewClients('',$cliente);
	}
	public function modify_client(Request $req){
		$this->validate($req,[
			'id' =>	'required|numeric',
    		'nombre' =>	'regex:/^[A-Za-z\s]+$/',
    		'email' =>	'email',
			'cedula' =>	'numeric',
    	]);
    	$persona = Persona::find($req->id);
        //Validar si la persona no se encuentra reportar error #3
		$user = User::where('id_persona',$persona->id)->get()->first();
    	$persona->nombre = $req->nombre;
		
    	if($req->cedula != $user->cedula){
			$persona->cedula = $req->cedula;
    	}
		
    	if($req->email != $user->email){
			$user->email = $req->email;
    	}
    	if($req->password!=null){
			$user->password = Hash::make($req->password);
    	}
    		
    	
    	$persona->save();
    	$user->save();
    	$persona = Persona::where('id',$persona->id)->with('usuario')->first();
    	return redirect()->back()->with('data',$persona);
    }
	/*
	Request:
		"_token"
		"cantBuy"
		"payWith"
		"type_operation"
	 */
	public function acquireCripto(Request $req){
		dd($req->all());
		$error= $this->validate($req,[
			'payWith' =>	'required|in:USD,EUR,GBP,INR,AUD,CAD,SGD,AED,AFN,ALL,AMD,ANG,AOA,ARS,AUD,AWG,AZN,BAM,BBD,BDT,BGN,BHD,BIF,BMD,BND,BOB,BRL,BSD,BTN,BWP,BYN,BZD,CAD,CDF,CHF,CLP,CNY,COP,CRC,CUC,CUP,CVE,CZK,DJF,DKK,DOP,DZD,EGP,ERN,ETB,EUR,FJD,GGP,GHS,GIP,GMD,GNF,GTQ,GYD,HKD,HNL,HRK,HTG,HUF,IDR,ILS,IMP,INR,IQD,IRR,ISK,JEP,JMD,JOD,JPY,KES,KGS,KHR,KMF,KPW,KRW,KWD,KYD,KZT,LAK,LBP,LKR,LRD,LSL,LYD,MAD,MDL,MGA,MKD,MMK,MNT,MOP,MRU,MUR,MVR,MWK,MXN,MYR,MZN,NAD,NGN,NIO,NOK,NPR,NZD,OMR,PAB,PEN,PGK,PHP,PKR,PLN,PYG,QAR,RON,RSD,RUB,RWF,SAR,SBD,SCR,SDG,SEK,SGD,SHP,SLL,SOS,SPL,SRD,STN,SVC,SYP,SZL,THB,TJS,TMT,TND,TOP,TRY,TTD,TVD,TWD,TZS,UAH,UGX,USD,UYU,UZS,VEF,VES,VND,VUV,WST,XAF,XAG,XAU,XBT,XCD,XDR,XOF,XPD,XPF,XPT,YER,ZAR,ZMW,ZWD',
			'cantBuy' =>	'required|numeric',
			'type_operation' =>	'required|in:Deposit,Change',
			'base' =>	'required|in:XRP,BTC,ETH,LTC,BCH,TRX,NANO,DASH,XLM,DAI,USDS,TUSD,BSV,ZEC,EOS,ETC,DOGE,BAT,SRN,TEL,BTT,REP,GNT,DGD,WINGS,RLC,DCR,ANT,BNT,CVC,PAY,OMG,MCO,ZRX,QTUM,STORJ,FUN,SALT,BTG,DGB,DNT,POWR,PPT,BRD,NOAH,BNB,POLY,KNC,MITH,LINK'
		]);
		$base=$req->base;
		$currency=$req->payWith;
		$tipo='buy';
		$datos = json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$base.'-'.$currency.'/'.$tipo), true );

		Transaccion::create([
    		'id_metodo_pago' => 1,
			'id_tipo_transaccion' => 1,
			'id_cliente' => Auth::user()->id,
    	]);

		return redirect()->back();
	}
		
}
