<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = "comisiones";
    protected $guarded = ['created_at','updated_at'];
    private $comisiones = [];

    public static function calcularComisionCompra($total_sin_comision,$total_add_general,$comisiones){
        if($total_sin_comision < 0.0001){
            return -1;
        }else{
            foreach($comisiones as $comision){

                if($total_sin_comision >= $comision['minimo'] && $total_sin_comision <= $comision['maximo']){
                    $info = [
                        'comision' => $comision['porcentaje'],
                        'total_con_comision_compra' => $total_add_compra = $total_add_general + ($total_sin_comision * ($comision['porcentaje']/100))
                    ];
                    return $info;
                }
                
            }
            return -1;
        }
    }
    
    /*
        Funcion que retorna las comisiones guardadas en la tabla 'comisiones'
        Si no recibe ningun parámetro, retornará todas las comisiones en un arreglo
        Si recibe un string, retornará la posicion del arreglo con esa comision
        Si recibe un array, retornará las posiciones del arreglo con esas comisiones
    */
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

        }else if(is_array($com)){

            $return = [];

            foreach($com as $index){
                $return[$index] = $arr[$index];
            }

            return $return;

        }else if(is_string($com)){

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
