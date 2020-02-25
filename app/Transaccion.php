<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $guarded = [];
    protected $table = "transacciones";
    public function tipoTransaccion(){
    	return $this->belongsTo('App\TipoTransaccion','id_transaccion');
    }
    public function metodoPago(){
    	return $this->belongsTo('App\MetodoPago','id_metodo_transaccion');
    }
    public function cliente(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }
    public function moderador(){
    	return $this->belongsTo('App\Moderador','id_moderador');
    }
    public function imagen(){
    	return $this->hasOne('App\ImagenTransaccion','id_transaccion');
    }    
    public function compraCriptomoneda(){
        return $this->hasOne('App\CompraCriptomoneda','id_transaccion');
    }
    
    
}
