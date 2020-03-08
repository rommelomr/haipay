<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HaiCriptomoneda extends Model
{
	protected $guarded = [];
	public function moneda(){
	    return $this->belongsTo('App\Moneda','id_moneda');
	}	
}
