<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HaiCriptomoneda;
use App\Moneda;
use App\Transaccion;
use App\CompraCriptomoneda;

class CriptomonedasController extends Controller
{

	private function consultarPrecioMoneda($coin){
		if($coin['id'] === 1){
			return 1;
		}else if($coin['id'] == 6){

			return json_decode( file_get_contents('https://api.coinlore.com/api/ticker/?id=2'), true )[0]['price_usd'];
		}else{
			return json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$coin['siglas'].'-USD'.'/buy'), true )['data']['amount'];
		}
	}
	public function acquireCripto(Request $req){
		$error= $this->validate($req,[
			'payWith' =>	'required|exists:monedas,siglas',
			'base' =>	'required|exists:hai_criptomonedas,id',
			'cuant_buy' =>	'required|numeric',
			'type_operation' =>	'required|exists:metodos_pago,id',
		]);

		//Si la moneda que se quiere comprar es el Doge (id 5)
		/*
		$base=HaiCriptomoneda::with('moneda')->find($req->base);
		$crip_to_buy = $this->consultarPrecio([
			'id'	=> $req->base,
			'siglas'=> $base->moneda->siglas,
		]);
		$pay = HaiCriptomoneda::with('moneda')->find($req->payWith);
		$crip_to_pay = $this->consultarPrecio([
			'id'	=> $req->base,
			'siglas'=> $pay->moneda->siglas,
		]);
		*/
		$buy=HaiCriptomoneda::with('moneda')->find($req->base);
		$pay=Moneda::where('siglas',$req->payWith)->first();
		$crip_to_buy=$this->consultarPrecioMoneda([
			'id' => $buy->moneda->id,
			'siglas' => $buy->moneda->siglas,
		]);
		$crip_to_pay=$this->consultarPrecioMoneda([
			'id' => $pay->id,
			'siglas' => $req->payWith,
		]);
		/*
		if($req->base == 5){
			//$crip_to_buy = json_decode( file_get_contents('https://api.coinlore.com/api/ticker/?id=2'), true )[0]['price_usd'];
		}else{

			$crip_to_buy = json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$base->moneda->siglas.'-USD'.'/buy'), true )['data']['amount'];
			//dd($req->cuant_buy * $crip_to_buy['data']['amount'] * (1 / $crip_to_pay['data']['amount']));
		}
		*/

		$transaccion = Transaccion::create([
    		'id_cliente' => \Auth::user()->cliente->id,
    		'id_tipo_transaccion'=>1
    	]);

    	$compra = CompraCriptomoneda::create([
			'id_hai_criptomoneda' => $req->base,
			'id_moneda' => Moneda::where('siglas',$req->payWith)->first()->id,
			'monto' => $req->cuant_buy,
			'precio_moneda_a_comprar' => $crip_to_buy,
			'precio_moneda_a_pagar' => $crip_to_pay,
			'id_metodo_pago' => $req->type_operation,
			'id_transaccion' => $transaccion->id
    	]);


		return redirect()->back();
	}	
}
