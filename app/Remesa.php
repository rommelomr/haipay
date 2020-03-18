<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remesa extends Model
{
    protected $table = 'remesas';
    protected $guarded = [];

    public function internal(){
    	return $this->hasOne(RemesaCliente::class,'id_remesa');
    }
    public function external(){
    	return $this->hasOne(RemesaNoUsuario::class,'id_remesa');
    }
    
}
