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
use App\Comision;

class RemesasController extends Controller
{

    public function enviarRemesas(Request $req){
        $this->validate($req,[
    		'nombre' => ['regex:/^[A-Za-z\s]+$/','nullable'],
    		'cedula' => 'required|digits_between:1,20',
    		'monto' =>	'required|numeric',
            'type_operation' =>	'required|exists:metodos_pago,id',
            'retirement_method' => 'required|exists:metodos_retiro,id',
        ]);
        $buscar=Persona::with(['usuario'=>function($query){
            $query->with('cliente');
        }])->where('cedula',$req->cedula)->first();
        if($buscar==null){
            if($req->nombre === null || !isset($req->nombre)){

                return redirect('dashboard_clients?tab=3')->with(['messages'=>['You must enter the full name if the receiver is not an user']]);
            }
        }
        //obtener comisiones
        $comision = Comision::getComisiones();

        //obtener el monto total
		
		$monto_sin_comision = $req->monto - ( $req->monto * ($comision['remesa'] / 100));

        $transaccion = Transaccion::create([
            'id_cliente'=>Auth::user()->cliente->id
    	]);
        
        $remesa = Remesa::create([
            'id_emisor'=> $transaccion->id_cliente,
            'id_transaccion'=> $transaccion->id,
            'monto'=> $monto_sin_comision,
            'monto_total'=> $req->monto,
            'comision_remesa'=> $comision['remesa'],
            'id_metodo_retiro'=> $req->retirement_method,
    	]);

        if($buscar != null){
            //existe el usuario en la bd
            if($buscar->es_usuario){
                //si es un usuario
                $remesaCliente = RemesaCliente::create([
                    'id_remesa'=> $remesa->id,
                    'id_cliente'=> $buscar->usuario->cliente->id,
                ]);
                $remesa->id_tipo_remesa = 1;
                $transaccion->id_tipo_transaccion = 1;
            }else{
                //no es un usuario, pero esta en la BD persona
                $remesaNoUsuario = RemesaNoUsuario::create([
                    'id_remesa'=> $remesa->id,
                    'id_no_usuario'=> $buscar->usuario->cliente->id,
                ]);
                $remesa->id_tipo_remesa = 2;
                $transaccion->id_tipo_transaccion = 2;
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
                $transaccion->id_tipo_transaccion = 2;
        }
    	$remesa->save();
        $transaccion->save();
    	return redirect('dashboard_clients?tab=4');
    }
    public function verificarRemesa(Request $req){
        
    }
    
    public function eliminarTransaccion(Request $req){
        $req->request->add(['user' => Auth::user()->Cliente->id]);
        $this->validate($req,[
            'id_transaction' => 'required|digits_between:1,20',
            'user' =>	'in:'.$transaccion= Transaccion::find($req->id_transaction)->id_cliente,
        ]);
        $transaccion= Transaccion::find($req->id_transaction) ;
        $transaccion->estado = 3;
        $transaccion->save();
        return redirect()->back();
    }
}
