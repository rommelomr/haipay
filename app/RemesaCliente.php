<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemesaCliente extends Model
{
    protected $fillable = ['id_remesa','id_cliente'];
    
}
