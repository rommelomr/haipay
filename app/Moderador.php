<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderador extends Model
{
	protected $table = 'moderadores';
	protected $guarded = [];
    public function transacciones(){
    	return $this->hasMany('App\Transaccion','id_moderador');
    }

    public function usuario(){
    	return $this->belongsTo('App\User','id_usuario');
    }
    
}
