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

class RetirosController extends Controller
{

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

    	$hai_criptomoneda = HaiCriptomoneda::find($request->hai_crypto_id);

    	$auth = \Auth::user();

    	$cliente = Cliente::where('id_usuario',$auth->id)->first();

    	$cartera = Cartera::where('id_hai_criptomoneda',$request->hai_crypto_id)
        	->where('id_cliente',$cliente->id)
        	->with('haiCriptomoneda')
        	->firstOrFail();

    	

    	$comision_retiro = Comision::getComisiones('withdraw');

    	if($request->charge_from == 0){
    		
	    	$monto_total = ($cartera->cantidad - $request->amount_to_retire) - ($request->amount_to_retire * ($comision_retiro['porcentaje']/100)) - ($cartera->haiCriptomoneda->comision_red);

	    	$cartera->cantidad = $monto_total;


    		$tipo = 'w';
    		$monto_total = $request->amount_to_retire;

    	}else{

            $cartera->cantidad -= $request->amount_to_retire;

            $monto_total = ($request->amount_to_retire - $hai_criptomoneda->comision_red) - ($request->amount_to_retire * ($comision_retiro['porcentaje']/100));

            $tipo = 'a';
    	}

	    $cartera->save();
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
            'id_metodo_retiro'         => $request->withdraw_method_id,
            'direccion'             => $cartera->direccion,
            'estado'                => 0
    	];
        Retiro::create($retiro_arr);

    	return redirect()->back()->with([
    		'messages'=>[
    			'Withdraw made successfully'
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
    	
    	$metodos_retiro = MetodoRetiro::whereIn('id',[2,3])->get();
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
