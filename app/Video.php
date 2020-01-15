<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $guarded = [];
    public function clientes(){
    	return $this->belongsToMany('App\Cliente','cliente_video','id_video','id_cliente');
    }
}
