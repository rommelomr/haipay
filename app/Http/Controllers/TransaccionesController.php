<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use App\Cartera;
use App\Cliente;

class TransaccionesController extends Controller
{

    private function getTransactions(){
        $moderador = \Auth::user()->moderador;
    	return $transacciones = Transaccion::with([
            'tipoTransaccion',
            'cliente'=>function($query){

    		  $query->with(['usuario'=>function($query){
    			$query->with('persona');
    		  }]);

    	}])
        ->where(function($query) use ($moderador){

            $query->whereHas('remesa',function($query) use ($moderador){

                $query->where('id_moderador',$moderador->id);

            })->orWhereHas('compraCriptomoneda',function($query) use ($moderador){

                $query->where('id_moderador',$moderador->id);

            });

        })
        ->where('estado',0)
        ->orderBy('created_at','DESC')
        ->paginate(10,['*'],'transacciones');
    }
    public function changeStateTransaction(Request $request){
        
        $request->validate([
            'transaction_id' => ['required','exists:transacciones,id'],
            'id_estado' => ['required','in:1,2']
        ]);

        $transaccion = Transaccion::with(['cliente','compraCriptomoneda'])
        ->find($request->transaction_id);
        
        $transaccion->estado = $request->id_estado;

        $transaccion->save();


        if($request->id_estado == 1){

            $message = 'Transaction approved';
            $cartera = Cartera::firstOrNew([
                'id_cliente' => $transaccion->cliente->id,
                'id_hai_criptomoneda' => $transaccion->compraCriptomoneda->id_hai_criptomoneda
            ]);
            
            $cartera->cantidad += $transaccion->compraCriptomoneda->monto;

            $cartera->save();

        }else{

            $message = 'Transacción cancelada';
        }

        return redirect()->route('transactions')->with(['messages'=>[$message]]);
    }
    public function showViewTransactions(){
        $transacciones = $this->getTransactions();
        
    	return view('transactions',[
            'watch' => false,
    		'transacciones' => $transacciones
    	]);
    }
    public function seeTransaction($id){

        $transaccion = Transaccion::with([

            'cliente'=>function($query){

                $query->with([

                    'usuario'=>function($query){

                        $query->with('persona');

                    },
                    'imagenesVerificacion'=>function($query){

                        $query->where('tipo',0);

                    }
                ]);

            }
            ,'imagen'

            ,'compraCriptomoneda'=>function($query){
                $query->with(['haiCriptomoneda','moneda']);
            }
            ,'remesa'=>function($query){
                $query->with([
                    'metodoRetiro',
                    'metodoPago',

                    'remesaInterna'=>function($query){

                        $query->with([

                            'cliente'=>function($query){

                                $query->with(['usuario'=>function($query){

                                    $query->with('persona');

                                }]);
                            }
                        ]);
                    },
                    'remesaExterna'=>function($query){
                        $query->with(['noUsuario'=>function($query){
                            $query->with('persona');
                        }]);
                    }]);
                }
            ,'trade'
            ,'retiro'
        ])->find($id);
        
        $transacciones = $this->getTransactions();

        return view('transactions',[
            'transacciones' => $transacciones,
            'watch' => true,
            'transaction' => $transaccion,
        ]);

    }
    /*
    public function deleteTransaction(Request $request){

        $user = \Auth::user();

        $cliente = Cliente::where('id_usuario',$user->id)->first();

        $transaccion = Transaccion::where('id',$request->id_transaction)
        ->where('id_cliente',$cliente->id)
        ->first();

        $transaccion->estado = 3;
        $transaccion->save();

        return redirect()->back()->with([
            'messages' => [
                'Transaction deleted succesfuly'
            ]
        ]);

    }
    */
}
