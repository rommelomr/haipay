<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Transaccion;
use App\Deposito;
use App\Retiro;
use App\Moderador;


class Moderador extends Model
{
	protected $table = 'moderadores';
	protected $guarded = [];
    public function transacciones(){
        return $this->hasMany('App\Transaccion','id_moderador');
    }
    public function depositos(){
        return $this->hasMany('App\Deposito','id_moderador');
    }

    public function usuario(){
    	return $this->belongsTo('App\User','id_usuario');
    }
    public function otorgar(){
    }

    public function otorgarTareas($turno,$class){
        
        $moderador_de_turno = Moderador::obtenerModeradorDeTurno($turno);

        $class::where('id_moderador', $this->id )

        ->chunkById(100,function($tarea)use(&$moderador_de_turno,$class,$turno){

            $arr    = [];

            $arr[0] = $tarea[0];

            $arr[1] = $tarea[count($tarea)-1];

            $class::where('id','>=',$arr[0]->id)
            ->where('id','<=',$arr[1]->id)
            ->update([
                'id_moderador'=>$moderador_de_turno->id
            ]);

            $moderador_de_turno = Moderador::obtenerModeradorDeTurno($turno);



        });


    }

    public static function obtenerModeradorDeTurno($type){
        
    	$moderador = Moderador::where($type,1)->first();

    	if($moderador != null){

    		$moderador->$type = 0;	
    		$moderador->save();	
    		return $moderador;

    	}else{

            Moderador::whereHas('usuario',function($query){
                $query->where('estado',1);
            })->update([$type => 1]);

	    	$moderador = Moderador::where($type,1)->first();
	    	$moderador->$type = 0;	
    		$moderador->save();	
    		return $moderador;
    		
    	}
	    	//Si no existe, resetear todos los moderadores a 1
	    	//volver a consultar el primer moderador con 1 y devolver el id
    	
    }
    
}
