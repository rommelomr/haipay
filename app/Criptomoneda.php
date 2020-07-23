<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criptomoneda extends Model
{
	protected $guarded = [];
	public function clientes(){
	    return $this->belongsToMany('App\Cliente','carteras','id_criptomoneda','id_cliente');
	}
	public function carteras(){
	    return $this->hasMany('App\Cartera','id_criptomoneda');
	}
	/*
		Método que consulta a las API el precio de la moneda en cuestion
		Recibe un arreglo con el ID y las SIGLAS de la moneda
		Ejemplo:
			'siglas' => DOGE,
		Retorna el precio de la cripto en cuestion expresado en Dólares americanos
	*/
	public static function consultarPrecioMoneda($coin){
		if($coin['siglas'] == 'USD'){
			return 1;
		}else if($coin['siglas'] === 'DOGE'){

			return json_decode( file_get_contents('https://api.coinlore.com/api/ticker/?id=2'), true )[0]['price_usd'];
		}else{
			return json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$coin['siglas'].'-USD'.'/buy'), true )['data']['amount'];
		}
	}
	/*
	Metodo que consulta a coinbase el precio de un par
	*/
	public static function consultarPrecioPar($coin){
		
		return json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$coin['buy'].'-'.$coin['pay'].'/buy'), true )['data']['amount'];
	}
		
}
