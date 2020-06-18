<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
	protected $guarded = [];
 	public function haiCriptomoneda(){

 		return $this->belongsTo('App\HaiCriptomoneda','id_hai_criptomoneda');   
 	}
 	public function clientes(){

 		return $this->belongsTo('App\Cliente','id_cliente');   
 	}
 	
}
