<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remesa extends Model
{
    protected $fillable = ['id_emisor','id_transaccion','monto'];
}
