<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
	protected $guarded = [];
 	public function criptomonedas(){

 		return belongsTo('App\Criptomoneda','id_criptomoneda');   
 	}
 	public function clientes(){

 		return belongsTo('App\Cliente','id_cliente');   
 	}
 	
}
