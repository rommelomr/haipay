<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenVerificacion extends Model
{
	protected $guarded = [];
    public function cliente(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }

}
