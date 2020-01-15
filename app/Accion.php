<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
	protected $guarded = [];
    public function auditorias(){
    	return hasMany('App\Auditoria','id_accion'):
    }
    
}
