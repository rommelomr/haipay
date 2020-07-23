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
    public function remesa(){
    	return $this->belongsTo(Remesa::class,'id_remesa');
    }

}
