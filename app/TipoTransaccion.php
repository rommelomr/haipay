<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTransaccion extends Model
{
	protected $guarded = [];
    public function transacciones(){
    	return $this->hasMany('App\Transaccion','id_tipo_transaccion');
    }
    
}
