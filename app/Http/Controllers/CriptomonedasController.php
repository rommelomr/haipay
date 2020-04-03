<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HaiCriptomoneda;
use App\Moneda;
use App\Transaccion;
use App\CompraCriptomoneda;
use App\Comision;

class CriptomonedasController extends Controller
{

	/*
		Método que consulta a las API el precio de la moneda en cuestion
		Recibe un arreglo con el ID y las SIGLAS de la criptomoneda
		Ejemplo:
			'id' => 6,
			'siglas' => DOGE,
		Retorna el precio de la cripto en cuestion expresado en Dólares americanos
	*/
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

		
		$comision = Comision::getComisiones();
		$buy=HaiCriptomoneda::with('moneda')->find($req->base);
		$pay=Moneda::where('siglas',$req->payWith)->first();


		//obtengo el precio de la cripto que voy a comprar
		$crip_to_buy=$this->consultarPrecioMoneda([
			'id' => $buy->moneda->id,
			'siglas' => $buy->moneda->siglas,
		]);

		//obtengo el precio de la cripto con que voy a pagar
		$crip_to_pay=$this->consultarPrecioMoneda([
			'id' => $pay->id,
			'siglas' => $req->payWith,
		]);

		//obtener el monto total
		$monto_calculado =  $req->cuant_buy*$crip_to_buy*(1/$crip_to_pay);
		$monto_total = $monto_calculado + ( $monto_calculado * ($comision['general'] / 100));
		
		$transaccion = Transaccion::create([
    		'id_cliente' => \Auth::user()->cliente->id,
    		'id_tipo_transaccion'=>3
    	]);
		
		

    	$compra = CompraCriptomoneda::create([
			'id_hai_criptomoneda' => $req->base,
			'id_moneda' => Moneda::where('siglas',$req->payWith)->first()->id,
			'monto' => $req->cuant_buy,
			'precio_moneda_a_comprar' => $crip_to_buy,
			'precio_moneda_a_pagar' => $crip_to_pay,
			'id_metodo_pago' => $req->type_operation,
			'id_transaccion' => $transaccion->id,
			'comision_general' => $comision['general'],
			'comision_compra' => $comision['compra'],
			'monto_total' => $monto_total,
    	]);


		return redirect()->back();
	}	
}
