<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comision;
use App\HaiCriptomoneda;
use App\Moneda;
use App\Cliente;
use App\Cartera;
use App\Transaccion;
use App\MetodoRetiro;
use App\CompraCriptomoneda;
use App\TipoTransaccion;
use Illuminate\Support\Facades\DB;

class ComprasCriptomonedaController extends Controller
{

    
    public function pursacheNotice(){
    	
    	if(session('pursache')){
    		session()->forget('pursache');
    		return view('pursache_notice');
    	}else{
    		session()->forget('pursache');
    		return redirect()->route('edit_profile')->with([
    			'messages'=>[
    				'The route you want to access is not valid'
    			]
    		]);

    	}
    }
    public function makeTrade(Request $request){


    	$request->validate([
			'buy' 		=>	'required|exists:monedas,siglas',
			'pay' 		=>	'required|exists:monedas,siglas',
			'amount' 	=>	'required|numeric|gt:0',
		]);

		$buy = Moneda::where('siglas',$request->buy)
		->with('haiCriptomoneda')
		->firstOrFail();

		$pay = Moneda::where('siglas',$request->pay)
		->with('haiCriptomoneda')
		->firstOrFail();

		$buy_price = CriptomonedasController::consultarPrecioMoneda([
			'id' => $buy->id,
			'siglas' => $buy->siglas,
		]);

		$pay_price = CriptomonedasController::consultarPrecioMoneda([
			'id' => $pay->id,
			'siglas' => $pay->siglas,
		]);

		$comision = Comision::getComisiones();

		$total_sin_comision = $buy_price / $pay_price * $request->amount;

		$total_con_comision_uno = $total_sin_comision + ($total_sin_comision * ($comision['general']/100));

		$total_con_comision_dos = $total_con_comision_uno + ($total_sin_comision * ($comision['cambio']/100));

		$transaccion = Transaccion::create([
    		'id_cliente' => \Auth::user()->cliente->id,
    		'id_tipo_transaccion'=>4
    	]);


		$user = \Auth::user();

		$cliente = Cliente::where('id_usuario',$user->id)->first();

    	$cartera_buy = Cartera::where('id_cliente',$cliente->id)
    	->where('id_hai_criptomoneda',$buy->haiCriptomoneda->id)
    	->first();

    	$cartera_pay = Cartera::where('id_cliente',$cliente->id)
    	->where('id_hai_criptomoneda',$pay->haiCriptomoneda->id)
    	->first();

		if($cartera_pay->cantidad - $total_con_comision_dos > 0){

			$cartera_pay->cantidad -= $total_con_comision_dos;
			$cartera_buy->cantidad += $request->amount;
			$cartera_pay->save();
			$cartera_buy->save();
	    	$compra = CompraCriptomoneda::create([
				'id_hai_criptomoneda' => $buy->haiCriptomoneda->id,

				'id_moneda' => $pay->id,

				'monto' => $request->amount,

				'precio_moneda_a_comprar' => $buy_price,

				'precio_moneda_a_pagar' => $pay_price,

				'id_metodo_pago' => 1,

				'id_transaccion' => $transaccion->id,

				'comision_general' => $comision['general'],

				'comision_compra' => $comision['cambio'],

				'total_sin_comision' => $total_sin_comision,

				'ganancia' => $total_con_comision_dos - $total_sin_comision,

				'total_con_comision' => $total_con_comision_dos,

	    	]);

	    	return redirect()->back()->with(['messages'=>[
	    		'Change made successfully'
	    	]]);

		}else{
			return redirect()->back()->with([
				'messages'=>[
					"insufficient fund"
				]
			]);
		}
    }
	public function buyCripto(Request $req){

		$error= $this->validate($req,[

			'base' =>	'required|exists:hai_criptomonedas,id',

			'amount' =>	'required|numeric|gt:0',

			'type_operation' =>	'required|exists:metodos_pago,id|gt:1',
			
		]);
				
		//$comision = Comision::getComisiones();

		$buy=HaiCriptomoneda::with('moneda')->find($req->base);
		
		$pay=Moneda::where('siglas','USD')->first();

		$user = \Auth::user();

		//obtengo el precio de la cripto que voy a comprar
		$price_crip_to_buy=CriptomonedasController::consultarPrecioMoneda([
			'id' => $buy->moneda->id,
			'siglas' => $buy->moneda->siglas,
		]);
		/*
		$price_crip_to_buy = 0.18;
		*/
		$total_sin_comision = $req->amount * $price_crip_to_buy;
		//dd($price_crip_to_buy);
		

		$comisiones = Comision::getComisiones(['general','buy 1','buy 2','buy 3']);
		
		$comision_general = $comisiones['general'];
		unset($comisiones['general']);

		$total_add_general = $total_sin_comision + ($total_sin_comision * ($comision_general['porcentaje']/100));

		$total_add_compra = Comision::calcularComisionCompra($total_sin_comision,$total_add_general,$comisiones);
		
		if($total_add_compra == -1){
			return redirect()->back()->with([
				'messages'=>[
					"The amount to pay must be over 0.0001$ and under 1000$"
				]
			]);
		}else{

			$tipo_transaccion = TipoTransaccion::where('nombre','Buy')->first();

			$compra_criptomoneda = CompraCriptomoneda::buyCrypto(
				\Auth::user()->cliente->id,
				$tipo_transaccion->id,
				$req->base,
				$pay->id,
				$req->amount,
				$price_crip_to_buy,
				1,
				$req->type_operation,
				$comision_general['porcentaje'],
				$total_add_compra['comision'],
				$total_sin_comision,
				$total_add_compra['total_con_comision_compra'],
				'g'
			);


	    	session()->flash('pursache');
			return redirect()->route('pursache_notice');
/*
			$transaccion = Transaccion::create([
	    		'id_cliente' => \Auth::user()->cliente->id,
	    		'id_tipo_transaccion'=>3,
	    	]);
	    	
	    	$compra = CompraCriptomoneda::create([
				'id_hai_criptomoneda' => $req->base,

				'id_moneda' => $pay->id,

				'monto' => $req->amount,

				'precio_moneda_a_comprar' => $price_crip_to_buy,

				'precio_moneda_a_pagar' => 1,

				'id_metodo_pago' => $req->type_operation,

				'id_transaccion' => $transaccion->id,

				'comision_general' => $comision_general['porcentaje'],

				'comision_compra' => $total_add_compra['comision'],

				'total_sin_comision' => $total_sin_comision,

				'ganancia' => $total_add_compra['total_con_comision_compra']-$total_sin_comision,

				'total_con_comision' => $total_add_compra['total_con_comision_compra'],

	    	]);
*/	    	
		}
	}	
}