<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemesaCliente extends Model
{
    protected $table = 'remesas_cliente';
    protected $guarded = [];

    public function cliente(){
    	return $this->belongsTo(Cliente::class,'id_cliente');
    }
    
}
