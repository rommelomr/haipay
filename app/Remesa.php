<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remesa extends Model
{
    protected $table = 'remesas';
    protected $guarded = [];

    public function internal(){
    	return $this->hasOne(RemesaCliente::class,'id_remesa');
    }
    public function external(){
    	return $this->hasOne(RemesaNoUsuario::class,'id_remesa');
    }
    public function transaccion(){
    	return $this->belongsTo(Transaccion::class,'id_transaccion');
    }

    public static function obtenerRemesa($cliente,$estado){

        return Remesa::whereHas('transaccion',function($query)use($estado){
            $query->where('estado',$estado);
        })->with(['internal'=>function($query){
            $query->with(['cliente'=>function($query){
                $query->with(['usuario'=>function($query){
                    $query->with('persona');
                }]);
            }]);
        },'external'=>function($query){
            $query->with(['noUsuario'=>function($query){
                $query->with('persona');
            }]);
        },'transaccion'=>function($query){
            $query->with('imagen');
        }])->where('id_emisor',$cliente->id)->orderBy('created_at','DESC');
    }
    
}
