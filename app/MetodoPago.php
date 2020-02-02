<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
	protected $table = 'metodos_pago';
	protected $guarded = [];
    public function transacciones(){
    	return $this->hasMany('App\Transaccion','id_metodo_pago');
    }
}
