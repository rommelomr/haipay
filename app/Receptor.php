<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receptor extends Model
{
	protected $guarded = [];
    public function persona(){
    	return $this->belongsTo('App\Persona','id_persona');
    }
    public function clientes(){
    	return $this->belongsToMany('App\Cliente','cliente_receptor','id_receptor','id_persona');
    }
    public function clienteReceptores(){
    	return $this->hasMany('App\ClienteReceptor','id_receptor');
    }
    
    
}
