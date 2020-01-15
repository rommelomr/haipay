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
	
}
