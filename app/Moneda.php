<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $guarded = [];
	public function haiCriptomoneda(){
	    return $this->hasOne('App\HaiCriptomoneda','id_moneda');
	}	
}
