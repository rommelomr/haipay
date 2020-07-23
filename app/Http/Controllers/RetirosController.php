<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartera;
use App\MetodoRetiro;
use App\Comision;

class RetirosController extends Controller
{
public function withdraw(Request $request){

    	dd($request->all());

    	$request->validate([
    		'amount_to_retire' => ['required','numeric'],
    		'charge_from' => ['required','in:0,1']
    	]);

    	//Calcular la comision
    	//Si es comision por wallet (0)
    		//(wallet - monto) - comision

    	//Si es comision por monto (1)
    		//wallet - monto

    }
    public function showWithdrawalsView($siglas){
    	$auth = \Auth::user();
    	$cartera = Cartera::whereHas('HaiCriptomoneda',function($query) use ($siglas){
    		$query->whereHas('moneda',function($query) use ($siglas){
    			$query->where('siglas',$siglas);

    		});

    	})->where('id_cliente',$auth->cliente->id)
    	->with([
    		'haiCriptomoneda'=> function($query){
    			$query->with(['moneda','origen']);
    		}
		])->firstOrFail();
    	
    	$metodos_retiro = MetodoRetiro::whereIn('id',[1,3])->get();
    	$comision_retiro = Comision::getComisiones('withdraw');
    	
    	return view('withdrawals.withdrawals',[
    		'cartera'=>$cartera,
    		'comision_retiro'=>$comision_retiro['porcentaje'],
    		'comision_red'=>$cartera->haiCriptomoneda->comision_red,
    		'metodos_retiro'=>$metodos_retiro,
    		'api_data'=> json_encode([
    			'id' => $cartera->haiCriptomoneda->origen->id,
    			'origen' => $cartera->haiCriptomoneda->origen->url,
    			'siglas' => $cartera->haiCriptomoneda->moneda->siglas,
    		]),
    	]);

    }
}
