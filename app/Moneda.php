<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $guarded = [];
	public function haiCriptomoneda(){
	    return $this->hasOne('App\HaiCriptomoneda','id_moneda');
	}	
	public static function consultarPrecioMoneda($coin){
		if($coin['id'] === 1){
			return 1;
		}else if($coin['id'] == 6){

			return json_decode( file_get_contents('https://api.coinlore.com/api/ticker/?id=2'), true )[0]['price_usd'];
		}else{
			return json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$coin['siglas'].'-USD'.'/buy'), true )['data']['amount'];
		}
	}

}
