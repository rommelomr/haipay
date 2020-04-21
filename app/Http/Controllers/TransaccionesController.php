<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;

class TransaccionesController extends Controller
{

    private function getTransactions(){
    	return $transacciones = Transaccion::with(['tipoTransaccion','cliente'=>function($query){
    		$query->with(['usuario'=>function($query){
    			$query->with('persona');
    		}]);
    	}])->where('estado',0)->orderBy('created_at','DESC')->paginate(10,['*'],'transacciones');
    }
    public function changeStateTransaction(Request $request){
        
        $request->validate([
            'id_transaction' => ['required','exists:transacciones,id'],
            'id_estado' => ['required','in:1,2']
        ]);
        $transaccion = Transaccion::find($request->id_transaction);
        
        $transaccion->estado = $request->id_estado;
        $transaccion->save();
        if($request->id_estado == 1){
            $message = 'Transacción aprobada';
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

        $transaccion = Transaccion::with(['cliente'=>function($query){
            $query->with(['usuario'=>function($query){
                $query->with('persona');
            },'imagenesVerificacion'=>function($query){
                $query->where('tipo',0);
            }]);
        }
        ,'imagen'
        ,'compraCriptomoneda'=>function($query){
            $query->with(['haiCriptomoneda','moneda']);
        }
        ,'remesa'=>function($query){
            $query->with([
                'metodoRetiro'
                ,'internal'=>function($query){
                    $query->with(['cliente'=>function($query){
                        $query->with(['usuario'=>function($query){
                            $query->with('persona');
                        }]);
                    }]);
                },'external'=>function($query){
                    $query->with(['noUsuario'=>function($query){
                        $query->with('persona');
                    }]);
                }]);
        }
        ,'trade'
        ,'retiro'])->find($id);
        
        
        $transacciones = $this->getTransactions();
        return view('transactions',[
            'transacciones' => $transacciones,
            'watch' => true,
            'transaction' => $transaccion,
        ]);

    }
}
