<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referido extends Model
{
	protected $guarded = [];
    public function clientePadre(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }
    public function datosCliente(){
    	return $this->belongsTo('App\Cliente','id_referido');
    }
    
}
