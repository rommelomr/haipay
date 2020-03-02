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

    public static function getComisiones(){
    	$comision = new Comision;
    	$comision->setComisiones();
    	return $comision->comisiones;
    }

}
