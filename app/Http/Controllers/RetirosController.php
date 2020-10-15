<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Retiro;
use App\Cartera;
use App\MetodoRetiro;
use App\HaiCriptomoneda;
use App\Criptomoneda;
use App\Cliente;
use App\Comision;
use App\Moderador;
use Illuminate\Support\Facades\DB;

class RetirosController extends Controller
{

public function changeMinimumToWithdraw(Request $req){


    $req->validate([
        'minimum' => ['required','numeric','min:0','max:30']
    ]);

    DB::table('minimum_to_withdraw')->update([
        'minimum' => $req->minimum
    ]);

    return redirect()->back()->with([
        'messages'=>[
            'Minimum changed successfully'
        ]
    ]);

}
public function rootWithdrawal(){
    $retiro = DB::table('minimum_to_withdraw')->first();
    
    return view('withdrawals.root_withdrawal',[
        'minimum' => $retiro->minimum
    ]);

}
public function completeWithdraw(Request $request){

    $request->validate([
        'id_retiro' => ['required','exists:retiros,id']
    ]);

    $retiro = Retiro::find($request->id_retiro);

    $retiro->estado = 1;
    $retiro->save();

    return redirect()->back()->with([
        'messages'=>[
            'withdraw completed successfully'
        ]
    ]);

}
public function seeWithdraw($id_retiro){

    $auth = \Auth::user();
    $moderador = Moderador::where('id_usuario',$auth->id)->first();

    $retiro = Retiro::where('id_moderador',$moderador->id)
    ->where('estado',0)
    ->with([
        'cliente'=>function($query){
            $query->with([
                'usuario'=>function($query){
                    $query->with([
                        'persona'
                    ]);
                }
            ]);
        },
        'haiCriptomoneda'=>function($query){
            $query->with('moneda');
        },
    ])->find($id_retiro);
    if($retiro == null){
        return redirect()->route('withdrawals');
    }
    $retiros = Retiro::where('id_moderador',$moderador->id)
        ->where('estado',0)
        ->with('Cliente')
        ->paginate(2);

    $precio_criptomoneda = Criptomoneda::consultarPrecioMoneda(['siglas'=>$retiro->haiCriptomoneda->moneda->siglas]);
    $precio_htg = Criptomoneda::consultarPrecioPar(['buy'=>'LTC','pay'=>'HTG']);
    $comision = Comision::getComisiones('general');
    
    
    $monto_a_enviar = round(($precio_htg*($retiro->monto_a_retirar - ($retiro->monto_a_retirar * $comision['porcentaje']/100))),2);    

    return view('withdrawals.withdrawals_mod',[
        'retiros' => $retiros,
        'retiro_actual' => $retiro,
        'monto_a_enviar' => $monto_a_enviar,
        'see' => true
    ]);
}
public function withdrawals(){

    $auth = \Auth::user();
    $moderador = Moderador::where('id_usuario',$auth->id)->first();

    $retiros = Retiro::where('id_moderador',$moderador->id)
        ->where('estado',0)
        ->with('Cliente')
        ->paginate(2);


    return view('withdrawals.withdrawals_mod',[
        'retiros' => $retiros,
        'see' => false
    ]);

}
public function withdraw(Request $request){


    	$request->validate([
    		'hai_crypto_id' => ['required','numeric'],
    		'amount_to_retire' => ['required','numeric'],
    		'charge_from' => ['required','in:0,1'],
            'withdraw_method_id' => ['required','exists:metodos_retiro,id']
    	]);

    	//Calcular la comision

    	$hai_criptomoneda = HaiCriptomoneda::with('moneda')->find($request->hai_crypto_id);

    	$auth = \Auth::user();

    	$cliente = Cliente::where('id_usuario',$auth->id)->first();

    	$cartera = Cartera::where('id_hai_criptomoneda',$request->hai_crypto_id)
        	->where('id_cliente',$cliente->id)
        	->with('haiCriptomoneda')
        	->firstOrFail();

    	$comision_retiro = Comision::getComisiones('withdraw');

        $comission = ($request->amount_to_retire * ($comision_retiro['porcentaje']/100));

        $charge_from_wallet = $request->charge_from == 0;

        $cripto_price = Criptomoneda::consultarPrecioMoneda(['siglas'=>$hai_criptomoneda->moneda->siglas]);

        $amount_in_usd = $cripto_price * $request->amount_to_retire;

        $minimum_to_withdraw = DB::table('minimum_to_withdraw')->first();

        $minimum_to_retire_valid = $amount_in_usd >= $minimum_to_withdraw->minimum;

        if($minimum_to_retire_valid){

            if($charge_from_wallet){

                $enough_crypto_in_wallet = $request->amount_to_retire + $comission <= $cartera->cantidad;

                if($enough_crypto_in_wallet){

                    $monto_total = ($cartera->cantidad - $request->amount_to_retire) - $comission - ($cartera->haiCriptomoneda->comision_red);

                    $cartera->cantidad = $monto_total;

                    $tipo = 'w';

                    $monto_total = $request->amount_to_retire;

                }else{

                    $message = "You don't have enough crypto to this withdrawal";

                }


            }else{

                $enough_crypto_in_wallet = $cartera->cantidad >= $request->amount_to_retire && $minimum_to_retire_valid;

                if($enough_crypto_in_wallet){

                    $monto_total = ($request->amount_to_retire - $hai_criptomoneda->comision_red) - $comission;

                    $cartera->cantidad -= $request->amount_to_retire;

                    $tipo = 'a';

                }else{

                    $message = "You don't have enough crypto to this withdrawal";

                }
                
            }            
        }else{

            $message = 'The minimum to withdraw is '.$minimum_to_withdraw->minimum.' USD';

        }

        if($minimum_to_retire_valid && $enough_crypto_in_wallet){

            $moderador_turno =  Moderador::obtenerModeradorDeTurno('turno_retiro');

        	$retiro_arr = [

    			'id_cliente' 			=> $cliente->id,
    			'id_hai_criptomoneda' 	=> $hai_criptomoneda->id,
                'id_moderador'          => $moderador_turno->id,
    			'comision_red' 			=> $hai_criptomoneda->comision_red,
    			'comision_retiro' 		=> $comision_retiro['porcentaje'],
    			'tipo' 					=> $tipo,
    			'monto_a_retirar'		=> $request->amount_to_retire,
    			'monto_total'			=> $monto_total,
                'id_metodo_retiro'      => $request->withdraw_method_id,
                'direccion'             => $cartera->direccion,
                'estado'                => 0
        	];

            Retiro::create($retiro_arr);

    	    $cartera->save();

            $message = 'Withdraw made successfully';

        }
    	return redirect()->back()->with([
    		'messages'=>[
    			$message
    		]
    	]);


    }
    public function showWithdrawalsView($siglas){
    	$auth = \Auth::user();
    	$cartera = Cartera::whereHas('HaiCriptomoneda',function($query) use ($siglas){
    		$query->whereHas('moneda',function($query) use ($siglas){
    			$query->where('siglas',$siglas);

    		});

    	})->where('id_cliente',$auth->cliente->id)
    	->with([
    		'haiCriptomoneda'=> function($query){
    			$query->with(['moneda','origen']);
    		}
		])->firstOrFail();
        
    	$metodos = [2];

        if($cartera->direccion != null){
            $metodos[] = 3;
        }

    	$metodos_retiro = MetodoRetiro::whereIn('id',$metodos)->get();
    	$comisiones = Comision::getComisiones(['withdraw','general']);
    	
    	return view('withdrawals.withdrawals',[
    		'cartera'=>$cartera,

    		'comision_retiro'=>$comisiones['withdraw']['porcentaje'],

            'comision_general'=>$comisiones['general']['porcentaje'],

    		'comision_red'=>$cartera->haiCriptomoneda->comision_red,

    		'metodos_retiro'=>$metodos_retiro,

    		'api_data'=> json_encode([

    			'id' => $cartera->haiCriptomoneda->origen->id,

    			'origen' => $cartera->haiCriptomoneda->origen->url,

    			'siglas' => $cartera->haiCriptomoneda->moneda->siglas,
                
    		]),
    	]);

    }
}
