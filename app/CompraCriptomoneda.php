<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraCriptomoneda extends Model
{
	protected $table = 'compras_criptomoneda';
    protected $guarded = [];
    public function haiCriptomoneda(){
    	return $this->belongsTo('App\haiCriptomoneda','id_hai_criptomoneda');
    }
 	public function moneda(){
        return $this->belongsTo('App\Moneda','id_moneda');
    }
}
