<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
	protected $guarded = [];
    public function acciones(){
    	return belongsTo('App\Accion','id_accion'):
    }
    public function users(){
    	return belongsTo('App\User','id_usuario'):
    }
    
}
