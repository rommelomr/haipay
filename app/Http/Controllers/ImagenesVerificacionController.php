<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartera;
use App\Criptomoneda;
use App\ImagenVerificacion;
use App\HaiCriptomoneda;
use Illuminate\Support\Facades\DB;

class ImagenesVerificacionController extends Controller
{
    public function verifyImage(Request $request){
               
    	//verificar si el id de la imagen (image_id) existe en la tabla imagenes_verificacion, en el campo id
    	//verificar si el estado (estado) es 1 o 2

    	$imagen = ImagenVerificacion::where('id',$request->image_id)
        ->with([
            'cliente'=>function($query) use ($request){
                $query->with([
                    'imagenesVerificacion' => function($query) use ($request){
                        $query->where('id','!=',$request->image_id);
    		        },
                    'referido' => function($query) use ($request){
                        $query->with('clientePadre');
                    },

                ]);
    	    }
        ])->first();

        //Cambiamos estado a LA IMAGEN, ya sea aprobada (1) o rechazada (0)
    	$imagen->estado = $request->status;


        //Si la imagen fue aprobada (1)
    	if($request->status == 1){
            
            //Si el cliente no ha sido verificado por un moderador
            if($imagen->cliente->estado!=1){

                //consultamos a ver si hay otra imagen
        		$otra_imagen = $imagen->cliente->imagenesVerificacion->first();
        		
                //Si hay otra imagen y ademas está aprobada
    	    	if(($otra_imagen!==null) && ($otra_imagen->estado===1)){

                    //Se cambia el estado del cliente
    	    		$imagen->cliente->estado = 1;

                    if($imagen->cliente->referido != null){

                        $comision = DB::table('comisiones_referido')->latest()->first();

                        $hai_criptomoneda = HaiCriptomoneda::find($comision->id_hai_criptomoneda);
                        $pair = Criptomoneda::consultarPrecioPar([
                            'buy' => 'XRP',
                            'pay' => 'USD'
                        ]);

                        $price = $comision->monto_en_usd / $pair;

                        Cartera::agregarCartera($imagen->cliente->referido->clientePadre->id, $hai_criptomoneda->id, $price);

                    }
                    
    	    	}
        	}
        	
        }
        $imagen->push();
    	return redirect()->back()->with(['messages'=>[
            'Image verified successfuly'
        ]]);

    }
}
