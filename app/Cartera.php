<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{

	protected $guarded = [];
 	public function haiCriptomoneda(){

 		return $this->belongsTo('App\HaiCriptomoneda','id_hai_criptomoneda');   
 	}
  	public function cryptoTag(){

 		return $this->hasOne('App\CryptoTag','id_cartera');   
 	}
 	
 	public function cliente(){

 		return $this->belongsTo('App\Cliente','id_cliente');   
 	}
 	public static function agregarCartera($client_id, $hai_criptomoneda_id, $monto){

		$cartera = Cartera::firstOrNew([
            'id_cliente' => $client_id,
            'id_hai_criptomoneda' => $hai_criptomoneda_id
        ]);
        
        $cartera->cantidad += $monto;

        $cartera->save();
 	}
 	
}
