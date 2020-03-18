<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoUsuario extends Model
{
    protected $table = 'no_usuarios';
    protected $fillable = ['id_persona'];
    public function persona(){
    	return $this->belongsTo(Persona::class,'id_persona');
    }
}
