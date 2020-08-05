<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retiro extends Model
{
    protected $table = 'retiros';
    protected $guarded = [];

    public function haiCriptoMoneda(){
    	return $this->belongsTo(HaiCriptomoneda::class,'id_hai_criptomoneda');
    }
    public function cliente(){
    	return $this->belongsTo(Cliente::class,'id_cliente');
    }
    public function moderador(){
    	return $this->belongsTo(Moderador::class,'id_moderador');
    }
    public function metodoRetiro(){
        return $this->belongsTo(MetodoRetiro::class,'id_metodo_retiro');
    }
    
    
}
