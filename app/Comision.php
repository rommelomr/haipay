<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = "comisiones";
    protected $guarded = ['created_at','updated_at'];
    private $comisiones = [];

    private function setComisiones(){
    	$comisiones = $this->first();
    	$arr = [
    		'general' => $comisiones->general,
    		'compra' => $comisiones->compra,
    		'remesa' => $comisiones->remesa,
    		'cambio' => $comisiones->cambio,
    		'retiro' => $comisiones->retiro,
    		'deposito' => $comisiones->deposito,
    	];
    	$this->comisiones = $arr;
    }

    public static function getComisiones($com = null){
        $comisiones = Comision::all();

        $arr = [];

        foreach($comisiones as $comision){

            $arr[strtolower($comision->nombre)] = [
                'minimo' => $comision->minimo,
                'maximo' => $comision->maximo,
                'porcentaje' => $comision->porcentaje,
            ];

        }
    	
        if($com == null){

    	   return $arr;
        }else{
            return $arr[$com];
        }
    }

    //Add the comission to an amount given
    //receive an array
    /*
        [
            
        ]
    */
    public static function calcularComision($arr){

        $comision = new Comision;
        $comision->setComisiones();

        foreach ($arr['comision'] as $key => $value){
            $arr['monto'] += $arr['monto']*($comision->comisiones[$value]/100);
        }

        return $arr['monto'];

    }

}
