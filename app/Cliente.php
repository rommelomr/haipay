<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [];
   public function usuario(){
    	return $this->belongsTo('App\User','id_usuario');
    }
    public function referidos(){
    	return $this->hasMany('App\Referido','id_cliente');
    }
    public function ImagenesVerificacion(){
    	return $this->hasMany('App\ImagenVerificacion','id_cliente');
    }
    public function carteras(){
    	return $this->hasMany('App\Cartera','id_cliente');
    }
    public function monedas(){
    	return $this->belongsToMany('App\Criptomoneda','carteras','id_cliente','id_criptomoneda',);
    }
    public function transacciones(){
    	return $this->hasMany('App\Transaccion','id_cliente');
    }
    public function receptores(){
    	return $this->belongsToMany('App\Receptor','receptores_remesa','id_cliente','id_receptor');
    }
    public function clienteReceptores(){
    	return $this->hasMany('App\ClienteReceptor','id_cliente');
    }
    
    
}
