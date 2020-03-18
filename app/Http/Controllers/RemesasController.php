<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use App\Remesa;
use App\Persona;
use App\RemesaCliente;
use App\RemesaNoUsuario;
use App\NoUsuario;
use Auth;
class RemesasController extends Controller
{
    public function enviarRemesas(Request $req){
        $this->validate($req,[
    		'nombre' => ['regex:/^[A-Za-z\s]+$/','nullable'],
    		'cedula' => 'required|digits_between:1,20',
    		'monto' =>	'required|numeric',
            'type_operation' =>	'required|exists:metodos_pago,id',
        ]);
        $buscar=Persona::where('cedula',$req->cedula)->first();
        if($buscar==null){
        

            if($req->nombre === null || !isset($req->nombre)){

                return redirect('dashboard_clients?tab=3')->with(['messages'=>['You must enter the full name if the receiver is not an user']]);
            }
        }
        
        $transaccion = Transaccion::create([
            'id_cliente'=>Auth::user()->cliente->id,
            'id_tipo_transaccion'=>2
    	]);
        
        $remesa = Remesa::create([
            'id_emisor'=> $transaccion->id_cliente,
            'id_transaccion'=> $transaccion->id,
            'monto'=> $req->monto,
    	]);

        if($buscar != null){
            //existe el usuario en la bd
            if($buscar->es_usuario){
                //si es un usuario
                $remesaCliente = RemesaCliente::create([
                    'id_remesa'=> $remesa->id,
                    'id_cliente'=> $transaccion->id_cliente,
                ]);
                $remesa->id_tipo_remesa = 1;
            }else{
                //no es un usuario, pero esta en la BD persona
                $remesaNoUsuario = RemesaNoUsuario::create([
                    'id_remesa'=> $remesa->id,
                    'id_no_usuario'=> $buscar->id,
                ]);
                $remesa->id_tipo_remesa = 2;
            }
        }else{
            //no existe en la BD
                $persona = Persona::create([
                    'nombre' => $req->nombre,
                    'cedula' => $req->cedula,
                    'es_usuario' => 0,
                ]);
                
                $NoUsuario = NoUsuario::create([
                    'id_persona'=> $persona->id,
                ]);

                $remesaNoUsuario = RemesaNoUsuario::create([
                    'id_remesa'=> $remesa->id,
                    'id_no_usuario'=> $NoUsuario->id,
                ]);
                $remesa->id_tipo_remesa = 2;
        }
    	$remesa->save();
    	return redirect('dashboard_clients?tab=4');
    }
}
