<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comision;

class HaiCriptomoneda extends Model
{
	protected $guarded = [];

	public function cartera(){
	    return $this->hasMany('App\Cartera','id_hai_criptomoneda');
	}	
    public function moneda(){
        return $this->belongsTo('App\Moneda','id_moneda');
    }   
	public function origen(){
	    return $this->belongsTo('App\Origen','id_origen');
	}	

	public static function calcularMonto($arr){
		$comision = Comision::getComisiones();

		$monto_sin_comision =  $arr['amount']*($arr['price_cryp_to_pay']/$arr['price_cryp_to_buy']);
        dd($arr['price_cryp_to_pay']/$arr['price_cryp_to_buy']);
        
        if(is_array($arr['comision'])){

            foreach($arr['comision'] as $value){

                $monto_con_comision = $monto_sin_comision + ( $monto_sin_comision * ($comision[$value] / 100));
            }
        }else{

		  $monto_con_comision = $monto_sin_comision + ( $monto_sin_comision * ($comision[$arr['comision']] / 100));
        }

		return [
			'sin_comision' => $monto_sin_comision,
			'con_comision' => $monto_con_comision,
		];


	}
	public static function setCurrentCryptos($cryptos_info,$crypto_pair){

        $arr_crypto = [];

        if($cryptos_info[0]->siglas == $crypto_pair[0]){

            $arr_crypto[0] = [
                'siglas' => $cryptos_info[0]->siglas,
                'origen' => $cryptos_info[0]->haiCriptomoneda->origen->url
            ];
            $arr_crypto[1] = [
                'siglas' => $cryptos_info[1]->siglas,
                'origen' => $cryptos_info[1]->haiCriptomoneda->origen->url
            ];
            
        }else{

            $arr_crypto[0] = [
                'siglas' => $cryptos_info[1]->siglas,
                'origen' => $cryptos_info[1]->haiCriptomoneda->origen->url
            ];
            $arr_crypto[1] = [
                'siglas' => $cryptos_info[0]->siglas,
                'origen' => $cryptos_info[0]->haiCriptomoneda->origen->url
            ];
        }

        return $arr_crypto;
	}

}
