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
        },'compraCriptomoneda'
        ,'remesa'=>function($query){
            $query->with(['internal','external']);
        }
        ,'trade'
        ,'retiro'])->find($id);

        $transacciones = $this->getTransactions();
        return view('transactions',[
            'transacciones' => $transacciones,
            'watch' => true,
            'transaction' => $transaccion
        ]);

    }
}
