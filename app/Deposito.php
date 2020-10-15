<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    protected $table = 'depositos';
    protected $guarded = [];

    public function cliente(){
    	return $this->belongsTo(Cliente::class,'id_cliente');
    }

    public function haiCriptomoneda(){
    	return $this->belongsTo(HaiCriptomoneda::class,'id_hai_criptomoneda');
    }
    
}
