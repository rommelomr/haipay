<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposito;
use App\Moderador;
use App\Moneda;
use App\TipoTransaccion;
use App\MetodoPago;
use App\Comision;
use App\Cartera;
use App\CompraCriptomoneda;
use Illuminate\Validation\Rule;

class DepositosController extends Controller
{
    public function listClientDeposits(Request $request){

    	$auth = \Auth::user();
    	$client = $auth->cliente;
    	$deposits = Deposito::where('id_cliente',$client->id)->paginate(10);


    	return view('deposits.client_deposits_list',[
    		'deposits' => $deposits
    	]);

    }
    public function verifyDeposit(Request $request){
    	//Cambiar estado al el depósito
    	//Crear Transaccion de compra
    	//Crear CompraCriptomoneda
    	
    	$request->validate([
    		'amount' => ['required_if:status,1','numeric','min:0'],
    		'status' => ['required','in:1,2'],
    		'deposit_id' => ['required','exists:depositos,id'],
    		'crypto_id' => ['required','exists:hai_criptomonedas,id'],
    	]);

    	$moneda = Moneda::whereHas('haiCriptomoneda',function($query) use ($request){
    		$query->where('id',$request->crypto_id);
    	})->first();

		$crypto_price = CriptomonedasController::consultarPrecioMoneda([
			'id' => $moneda->id,
			'siglas' => $moneda->siglas,
		]);

		$deposit = Deposito::find($request->deposit_id);

		$transaction_type = TipoTransaccion::where('nombre','Buy')->first();

		$payment_method = MetodoPago::where('nombre','Crypto deposit')->first();

		$comissions = Comision::getComisiones(['general','deposit']);

		$total_without_comission = $request->amount;

		$total_sub_general_comission = $total_without_comission - ($total_without_comission * ($comissions['general']['porcentaje']/100));

		$total_sub_comissions = $total_sub_general_comission - ($total_without_comission * ($comissions['deposit']['porcentaje']/100));

		if($request->status != 2){

			CompraCriptomoneda::buyCrypto(

				$deposit->id_cliente, 

				$transaction_type->id,

				$request->crypto_id,

				$moneda->id,

				$request->amount,

				$crypto_price,

				$crypto_price,

				$payment_method->id,

				$comissions['general']['porcentaje'],

				$comissions['deposit']['porcentaje'],

				$total_without_comission,

				$total_sub_comissions,

				'd'

			);

			Cartera::agregarCartera($deposit->id_cliente,$request->crypto_id,$total_sub_comissions);

		}
		$deposit = Deposito::find($request->deposit_id);

		$deposit->estado = $request->status;

		$deposit->save();

		return redirect()->back()->with([
			'messages'=>[
				'Deposit updated successfully'
			]
		]);


    }
    public function listModDeposits(){
    	$deposits = Deposito::with([
    		'cliente'=>function($query){
	    		$query->with(['usuario'=>function($query){
	    			$query->with('persona');
	    		}]);
	    	},
	    	'haiCriptomoneda'=>function($query){
	    		$query->with('moneda');
	    	}
	    ])->where(function($query){
	    	$moderador = \Auth::user()->moderador;
	    	$query->where('estado',0)
	    	->where('id_moderador',$moderador->id);
	    })->paginate(10);
	    
    	return view('deposits.mod_deposits',[
    		'deposits' => $deposits
    	]);
    }
    public function saveDeposit(Request $request){

    	$request->validate([

    		'hai_crypto_id' => ['required','exists:hai_criptomonedas,id'],

    		'url' => ['required','url'],

    		'image' => ['required','image','max:7680'],

    	]);

    	$name = time().$request->file('image')->getClientOriginalName();

    	$route = 'public/deposits';

		$request->file('image')->storeAs($route,$name);

		$auth = \Auth::user();

		$cliente = $auth->cliente;

		$moderador = Moderador::obtenerModeradorDeTurno('turno_deposito');

    	Deposito::create([

    		'id_cliente' => $cliente->id,

    		'id_moderador' => $moderador->id,

    		'id_hai_criptomoneda' => $request->hai_crypto_id,

    		'url' => $request->url,

    		'imagen' => $route.'/'.$name,

    	]);
    	return redirect()->back()->with([
    		'messages'=>[
    			'Deposit send successfully'
    		]
    	]);
    }
}
