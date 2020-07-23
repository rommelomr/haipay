<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoTag extends Model
{
	protected $table = 'crypto_tags';
	protected $guarded = [];
	
    public function cartera(){
    	return $this->belongsTo(Cartera::class,'id_cartera');
    }
}
