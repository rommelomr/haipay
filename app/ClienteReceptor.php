<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteReceptor extends Model
{
	protected $guarded = [];
    public function cliente(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }
    public function receptor(){
    	return $this->belongsTo('App\Receptor','id_receptor');
    }
    
}
