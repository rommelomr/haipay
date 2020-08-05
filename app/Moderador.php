<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Moderador extends Model
{
	protected $table = 'moderadores';
	protected $guarded = [];
    public function transacciones(){
    	return $this->hasMany('App\Transaccion','id_moderador');
    }

    public function usuario(){
    	return $this->belongsTo('App\User','id_usuario');
    }
/*
	Metodo que devuelve el id del moderador al que se le debe asignar la transacción en curso

*/
    public static function obtenerModeradorDeTurno($type){

    	$moderador = Moderador::where($type,1)->first();

    	if($moderador != null){

    		$moderador->$type = 0;	
    		$moderador->save();	
    		return $moderador;

    	}else{
    		DB::table('moderadores')
    			->update([$type => 1]);

	    	$moderador = Moderador::where($type,1)->first();
	    	$moderador->$type = 0;	
    		$moderador->save();	
    		return $moderador;
    		
    	}
	    	//Si no existe, resetear todos los moderadores a 1
	    	//volver a consultar el primer moderador con 1 y devolver el id
    	
    }
    
}
