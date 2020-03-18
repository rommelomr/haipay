<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemesaNoUsuario extends Model
{
    protected $table = "remesas_no_usuario";
    protected $guarded = [];

    public function noUsuario(){
    	return $this->belongsTo(NoUsuario::class,'id_no_usuario');
    }

}
