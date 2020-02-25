<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenTransaccion extends Model
{
	protected $table = 'imagenes_transaccion';
	protected $guarded = [];
    public function transaccion(){
    	return $this->belongsTo('App\Transaccion','id_transaccion');
    }
}
