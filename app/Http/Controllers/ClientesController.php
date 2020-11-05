<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\User;
use App\NoUsuario;
use App\Cliente;
use App\MetodoPago;
use App\MetodoRetiro;
use App\Remesa;
use Illuminate\Support\Facades\Hash;
use App\Transaccion;
use App\Comision;
use App\HaiCriptomoneda;
use App\CompraCriptomoneda;
use App\Cartera;
use App\CryptoTag;
use App\Moneda;

class ClientesController extends Controller
{
    //View in which clients can list remittances that other people have made them
    public function verifyAccount($code){
        
        $user = User::where('remember_token',$code)->first();
        if($user != null){

            $user->verificado = 1;

            $user->updateRememberToken();
            $user->save();
            
            $message = 'Your email has been verified';

        }else{

            $message = 'The validation URL is not valid';
            
        }
            return redirect()->route('login')->with([
                'messages'=>[
                    $message
                ]
            ]);
        //Cambiar el estado del usuario

        //Cambiar el token

        //Redirigir al login

    }
    public function showMyRemittancesView(){

        $user = \Auth::user();

        $remittances = Remesa::with([

            'remesaInterna',

            'remesaExterna',

            'emisor',
            'transaccion',

            'metodoRetiro'

        ])

        ->where(function($query){
            $query->where('estado',0)

            ->whereHas('transaccion',function($query){
                $query->where('estado',1);
            });
        })
        ->where(function($query)use($user){

            $query->whereHas('remesaInterna',function($query)use($user){

                $query->where('id_cliente',$user->cliente->id);

            })

            ->orWhereHas('remesaExterna',function($query)use($user){

                $query->whereHas('noUsuario',function($query)use($user){

                    $query->where('id_persona',$user->persona->id);

                });

            });
        })

        ->paginate(8);
        
        return view('remittances.list_remittances_client',[
            'remittances' => $remittances
        ]);

    }

    public function verifyImages($id){

        $client = Cliente::with([
            'imagenesVerificacion',
            'usuario' => function($query){
                $query->with('persona');
            }
        ])
        ->find($id);

        return view('clients/verify_client',[
            'client' => $client
        ]);

    }
    public function depositCrypto($crypto){

        $criptomoneda = HaiCriptomoneda::whereHas('moneda',function($query)use($crypto){

            $query->where('siglas',$crypto);

        })
        ->with(['origen','moneda'])
        ->firstOrFail();

        $metodos_pago = MetodoPago::where('id','>',2)->get();

        $comisiones = Comision::getComisiones(['deposit','general']);

        $user = \Auth::user();

        $cliente = Cliente::where('id_usuario',$user->id)->first();
        
        $carteras = Cartera::with(['haiCriptomoneda'=>function($query){
            $query->with('moneda');
        }])->where('id_cliente',$cliente->id)->paginate(10);

        return view('buys.deposit',[
            'carteras' => $carteras,
            'criptomoneda' => $criptomoneda,
            'metodos_pago' => $metodos_pago,
            'comisiones' => $comisiones,
        ]);

    }
    public function buyCripto($crypto){

        $criptomoneda = HaiCriptomoneda::whereHas('moneda',function($query)use($crypto){

            $query->where('siglas',$crypto);

        })
        ->with(['origen','moneda'])
        ->firstOrFail();

        $metodos_pago =MetodoPago::where('id','<>',1)->where('id','<>',12)->get();

        $comisiones = Comision::getComisiones();
        
        $user = \Auth::user();

        $cliente = Cliente::where('id_usuario',$user->id)->first();
        
        $carteras = Cartera::with(['haiCriptomoneda'=>function($query){
            $query->with('moneda');
        }])->where('id_cliente',$cliente->id)->paginate(10);

        return view('buy_crypto',[
            'carteras' => $carteras,
            'criptomoneda' => $criptomoneda,
            'metodos_pago' => $metodos_pago,
            'comision_general' => $comisiones['general']['porcentaje'],

            'comisiones_compra' => json_encode([
                'buy_1' => $comisiones['buy 1'],
                'buy_2' => $comisiones['buy 2'],
                'buy_3' => $comisiones['buy 3'],
            ]),
        ]);

    }
    public function updateTag(Request $request){

        session()->flash('wallet',true);

        $request->validate([
            'string'  => ['required','min:20','max:50','regex:/^[a-zA-Z0-9]+$/'],
        ]);

        $auth = \Auth::user();

        $tag = CryptoTag::firstOrCreate([
            'id_cartera'=>$request->father
        ],[
            'tag'=>$request->string
        ]);
        
        $tag->tag = $request->string;
        $tag->save();
        
        return redirect()->back()->with([
          'messages'=>[
            'Tag changed successfully'
          ]
        ]);
    }
    public function updateAdress(Request $request){


        $auth = \Auth::user();

        $cartera = Cartera::where('id_cliente',$auth->cliente->id)->whereHas('haiCriptomoneda',function($query)use($request){

          $query->where('id',$request->father);

        })->firstOrFail();

        session()->flash('wallet',true);
        session()->flash('cartera',$cartera->id);

        $request->validate([
            'string'  => ['required','min:20','max:50','regex:/^[a-zA-Z0-9]+$/'],
        ]);
        
        $cartera->direccion = $request->string;
        $cartera->save();
        
        return redirect()->back()->with([
          'messages'=>[
            'Addres changed successfully'
          ]
        ]);

    }
    public function verifyPyments(){
        $compras = CompraCriptomoneda::getCompras(null);
        
        return view('payments.verify_pyments',[
            'compras' => $compras,
            'selected_button' => 0,
            'title' => 'Verify Transactions'
        ]);
    }

    public function waitingPyments(){
        $compras = CompraCriptomoneda::getCompras(0);

        return view('payments.verify_pyments',[
            'compras' => $compras,
            'selected_button' => 1,
            'title' => 'Transactions waiting for approval'
        ]);
    }

    public function approvedPyments(){
        $compras = CompraCriptomoneda::getCompras(1);

        return view('payments.verify_pyments',[
            'compras' => $compras,
            'selected_button' => 2,
            'title' => 'Approved Transactions'
        ]);
    }

    public function canceledPyments(){
        $compras = CompraCriptomoneda::getCompras(2);

        return view('payments.verify_pyments',[
            'compras' => $compras,
            'selected_button' => 3,
            'title' => 'Canceled Transactions'
        ]);
    }
    public function trade($crypto){

        $current_crypto = HaiCriptomoneda::whereHas('moneda',function($query)use($crypto){
            $query->where('siglas',$crypto);
        })->firstOrFail();


        $cartera = Cartera::whereHas('haiCriptomoneda',function($query)use($crypto){
            $query->whereHas('moneda',function($query) use ($crypto){
                $query->where('siglas',$crypto);

            });
        })->first();

        if($cartera == null){
            return redirect()->back()->with([
                'messages' =>[
                    "You don't have this crypto in your wallet. You can't trade it"
                ]
            ]);
        }else{

            $comision = Comision::getComisiones();

            $coinbase_cryptos = HaiCriptomoneda::where('id_origen',1)

            ->whereHas('moneda',function($query)use($crypto){

                $query->where('siglas','<>',$crypto);

            })->with(['moneda','origen'])->get();

            $coinlore_cryptos = HaiCriptomoneda::where('id_origen',2)
            
            ->whereHas('moneda',function($query)use($crypto){
                $query->where('siglas','<>',$crypto);
            })->with(['moneda','origen'])->get();

            $info_cryptos = HaiCriptomoneda::obtenerInfoCriptos($coinbase_cryptos,$coinlore_cryptos);

            $all_pairs = HaiCriptomoneda::inicializarPares($coinbase_cryptos,$coinlore_cryptos,$current_crypto);
            
            return view('trade',[
                'all_pairs'       => json_encode($all_pairs),

                'current_crypto'    => $current_crypto,
                'info_cryptos_arr'       => $info_cryptos,
                'info_cryptos_json'      => json_encode($info_cryptos),
                'comision_trade'    => $comision['trade']['porcentaje'],
                'comision_general'    => $comision['general']['porcentaje'],
            ]);
        }
    }

    public function showDashboard(){

        //Buy cripto
		$hai_criptomonedas = HaiCriptomoneda::with('Moneda')->paginate(25);

		$monedas = Moneda::all();

		$metodos_pago = MetodoPago::all();

        //Verify_pyments
        $cliente = \Auth::user()->cliente;

        //Remesa sin imagen
        $pending_remittances = Remesa::obtenerRemesa($cliente,null)->paginate(5,['*'],'pending_remittances');

        //Remesa con imagen esperando por aprobación
        $for_approval_remmitances = Remesa::obtenerRemesa($cliente,0)->paginate(5,['*'],'for_approval_remmitances');

        //Remesa con imagen aprobada
        $approved_remittances = Remesa::obtenerRemesa($cliente,1)->paginate(5,['*'],'approved_remittances');

        //Remesa con imagen rechazada
        $refused_remittances = Remesa::obtenerRemesa($cliente,2)->paginate(5,['*'],'refused_remittances');

        $retirement_methods = MetodoRetiro::all();


            $comision = Comision::getComisiones();

            $coinbase_cryptos = HaiCriptomoneda::where('id_origen',1)
            ->with(['moneda','origen'])->get();

            $coinlore_cryptos = HaiCriptomoneda::where('id_origen',2)
            ->with(['moneda','origen'])->get();

            $info_cryptos = HaiCriptomoneda::obtenerInfoCriptos($coinbase_cryptos,$coinlore_cryptos);

            $carteras = Cartera::with(['haiCriptomoneda'=>function($query){
                $query->with('moneda');
            }])->where('id_cliente',$cliente->id)->paginate(10);

    	return view('dashboard_clients', [
    		'criptomonedas' => $hai_criptomonedas,
    		'monedas' => $monedas,
    		'metodos_pago' => $metodos_pago,
            'retirement_methods' => $retirement_methods,
            'pending_remittances' => $pending_remittances,
            'approved_remittances' => $approved_remittances,
            'for_approval_remmitances' => $for_approval_remmitances,
            'refused_remittances' => $refused_remittances,
            'carteras' => $carteras,

            'comision_general' => json_encode($comision['general']),
            'comision_compra' => json_encode(
                [
                    'buy 1' => $comision['buy 1'],
                    'buy 2' => $comision['buy 2'],
                    'buy 3' => $comision['buy 3'],
                ]
            ),
            'info_cryptos' => json_encode($info_cryptos),
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
        $moderador = \Auth::user()->moderador;
        
		$clientes_verificar =Cliente::where('estado',0)->where('id_moderador',$moderador->id)->whereHas('imagenesVerificacion',function($query){
            $query->where('estado',0);

        })->with(['imagenesVerificacion','usuario'=>function($query){
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
    public function setTrade($pair){

        $crypto_pair = explode('-',$pair);
        
        if(count($crypto_pair) == 2){

            $cryptos_info = Moneda::whereIn('siglas',$crypto_pair)
            ->with(['haiCriptomoneda'=>function($query){
                $query->with('origen');
            }])
            ->get();

            $arr_crypto = HaiCriptomoneda::setCurrentCryptos($cryptos_info,$crypto_pair);

            $comissions = Comision::getComisiones();

            $general_comision =$comissions['general']['porcentaje'];
            $change_comision =$comissions['trade']['porcentaje'];


            $cartera = Cartera::where('id_cliente',\Auth::user()->cliente->id)

            ->whereHas('haiCriptomoneda',function($query)use($crypto_pair){

                $query->whereHas('moneda',function($query)use($crypto_pair){

                    $query->where('siglas',$crypto_pair[1]);
                });
            })
            ->first();
            if($cartera == null){
                return redirect()->route('dashboard_clients')->with([
                    'messages' => [
                        "You don't have this crypto in your wallet. You can't trade it"
                    ]
                ]);
            }

            return view('set_trade',[
                'json_cryp_to_buy' =>json_encode($arr_crypto[0]),
                'json_cryp_to_pay' =>json_encode($arr_crypto[1]),
                'cryp_to_buy' => $arr_crypto[0]['siglas'],
                'cryp_to_pay' => $arr_crypto[1]['siglas'],
                'general_comission' => $general_comision,
                'change_comission' => $change_comision,
                'cartera' => $cartera,
                'buy'    => $crypto_pair[0],
                'pay'    => $crypto_pair[1],
            ]);


        }else{

            return abort(404);
        }
    }

		
}
