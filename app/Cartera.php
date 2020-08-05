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
 	
}
