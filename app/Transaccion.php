<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $guarded = [];
    protected $table = "transacciones";
    public function tipoTransaccion(){
    	return $this->belongsTo('App\TipoTransaccion','id_tipo_transaccion');
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
    public function trade(){
        return $this->belongsTo(Moderador::class,'estonosirveaunjaja');
    }
    public function retiro(){
        return $this->belongsTo(Moderador::class,'estonosirveaunjaja');
    }
    public function remesa(){
        return $this->hasOne('App\Remesa','id_transaccion');
    }
    /*
    *
    * Busca las transacciones de un usuario en especifico
    * Recibe el cliente en cuestion y el estado de las transacciones a buscar
    */
    public static function obtenerTransaccionPago($cliente,$estado){
        return Transaccion::where('id_tipo_transaccion',3)->with(['compraCriptomoneda'=>function($query){
            $query->with(['haiCriptomoneda'=>function($query){
                $query->with('moneda');
            },'moneda']);
        }])->where('id_cliente',$cliente->id)->where('estado',$estado);

    }
    public static function obtenerRemesa($cliente,$estado){
        return Transaccion::where('id_tipo_transaccion',3)->with(['compraCriptomoneda'=>function($query){
            $query->with(['haiCriptomoneda'=>function($query){
                $query->with('moneda');
            },'moneda']);
        }])->where('id_cliente',$cliente->id)->where('estado',$estado);

    }
    public function obtenerMontoAPagar(){
        
        if($this->compraCriptomoneda->monto * $this->compraCriptomoneda->precio_moneda_a_comprar * (1 /$this->compraCriptomoneda->precio_moneda_a_pagar) < 0.0001){


            return (string)number_format($this->compraCriptomoneda->monto*$this->compraCriptomoneda->precio_moneda_a_comprar * (1 /$this->compraCriptomoneda->precio_moneda_a_pagar),explode('-',(string)$this->compraCriptomoneda->precio/$this->compraCriptomoneda->monto)[1]+3);
        }else{

            return (string)$this->compraCriptomoneda->monto*$this->compraCriptomoneda->precio_moneda_a_comprar * (1 /$this->compraCriptomoneda->precio_moneda_a_pagar);
            
        }
        
    }
    public function obtenerMontoAComprar(){
        if((float)$this->compraCriptomoneda->monto < 0.0001){
            return number_format((float)$this->compraCriptomoneda->monto,explode('-',$this->compraCriptomoneda->monto)[1]+3);
        }else{
            return (float)$this->compraCriptomoneda->monto;
        }
    }

}
