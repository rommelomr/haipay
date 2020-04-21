<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImagenVerificacion;

class ImagenesVerificacionController extends Controller
{
    public function verifyImage(Request $request){   	
    	//verificar si el id de la imagen (id_imagen) existe en la tabla imagenes_verificacion, en el campo id
    	//verificar si el estado (estado) es 1 o 2

    	$imagen = ImagenVerificacion::where('id',$request->id_imagen)->with(['cliente'=>function($query) use ($request){
    		$query->with(['imagenesVerificacion'=>function($query) use ($request){
    			$query->where('id','!=',$request->id_imagen);
    		}]);
    	}])->first();
        if($imagen->cliente->estado!=1){
            
        	$imagen->estado = $request->estado;
        	if($request->estado == 1){
        		$otra_imagen = $imagen->cliente->imagenesVerificacion->first();
        		
    	    	if(($otra_imagen!==null) && ($otra_imagen->estado===1)){
    	    		$imagen->cliente->estado = 1;
    	    	}
        	}
        	
        	$imagen->push();
        }
    	return redirect()->back();

    }
}
