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
    private static function obtenerUrlCriptos($coinbase_cryptos,$coinlore_cryptos){
        $info_cryptos = [
            'coinbase'  => [
                'url'   => $coinbase_cryptos[0]->origen->url,
                'cryptos'  => [],
            ],
            'coinlore'  => [
                'url'   => $coinlore_cryptos[0]->origen->url,
                'cryptos'   => [],
            ]
        ];
        return $info_cryptos;
    }   
    public static function inicializarPares($coinbase_cryptos,$coinlore_cryptos,$current_crypto){

        $all_pairs = [];

        foreach($coinbase_cryptos as $value){
            $all_pairs[$value->moneda->siglas.'-'.$current_crypto->moneda->siglas] = 0;

        }

        foreach($coinlore_cryptos as $value){
            $all_pairs[$value->moneda->siglas.'-'.$current_crypto->moneda->siglas] = 0;
        }
        $all_pairs[$current_crypto->moneda->siglas.'-'.$current_crypto->moneda->siglas] = 0;
        return $all_pairs;

    }   
    private static function obtenerSiglasCriptos($info_cryptos,$coinbase_cryptos,$coinlore_cryptos){
        foreach($coinbase_cryptos as $value){
            $info_cryptos['coinbase']['cryptos'][] = $value->moneda->siglas;

        }

        foreach($coinlore_cryptos as $value){
            $info_cryptos['coinlore']['cryptos'][] = $value->moneda->siglas;
        }
        return $info_cryptos;
    }   
    public static function obtenerInfoCriptos($coinbase_cryptos,$coinlore_cryptos){

        $info_cryptos = HaiCriptomoneda::obtenerUrlCriptos($coinbase_cryptos,$coinlore_cryptos);
        $info_cryptos = HaiCriptomoneda::obtenerSiglasCriptos($info_cryptos,$coinbase_cryptos,$coinlore_cryptos);
        return $info_cryptos;
        
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
