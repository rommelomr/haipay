<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemesaNoUsuario extends Model
{
    protected $table = "remesas_no_usuario";
    protected $fillable = ['id_remesa','id_no_usuario'];
}
