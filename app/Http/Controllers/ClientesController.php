<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\User;
use App\Cliente;
use App\MetodoPago;
use App\Remesa;
use Illuminate\Support\Facades\Hash;
use App\Transaccion;
use App\HaiCriptomoneda;
use App\Moneda;

class ClientesController extends Controller
{
    public function showDashboard(){
        //Buy cripto
		$hai_criptomonedas =HaiCriptomoneda::with('Moneda')->get();
		$monedas =Moneda::all();
		$metodos_pago =MetodoPago::all();

        //Verify_pyments
        $client = \Auth::user()->cliente;

        $without_verify = Transaccion::where('id_tipo_transaccion',3)->with(['compraCriptomoneda'=>function($query){
            $query->with(['haiCriptomoneda'=>function($query){
                $query->with('moneda');
            },'moneda']);
        }])->where('id_cliente',$client->id)->where('estado',null)->get();
        
        $waiting_for_approval = Transaccion::where('id_tipo_transaccion',3)->with(['compraCriptomoneda'=>function($query){
            $query->with(['haiCriptomoneda'=>function($query){
                $query->with('moneda');
            },'moneda']);
        }])->where('id_cliente',$client->id)->where('estado',0)->get();

        $approved_transactions = Transaccion::where('id_tipo_transaccion',3)->with(['compraCriptomoneda'=>function($query){
            $query->with(['haiCriptomoneda'=>function($query){
                $query->with('moneda');
            },'moneda']);
        }])->where('id_cliente',$client->id)->where('estado',1)->get();

        $canceled = Transaccion::where('id_tipo_transaccion',3)->with(['compraCriptomoneda'=>function($query){
            $query->with(['haiCriptomoneda'=>function($query){
                $query->with('moneda');
            },'moneda']);
        }])->where('id_cliente',$client->id)->where('estado',2)->get();

        $auth = \Auth::user();
        $cliente = Cliente::where('id_usuario',$auth->id)->first();
        $remittances = Remesa::with(['internal'=>function($query){
            $query->with(['cliente'=>function($query){
                $query->with(['usuario'=>function($query){
                    $query->with('persona');
                }]);
            }]);
        },'external'=>function($query){
            $query->with(['noUsuario'=>function($query){
                $query->with('persona');
            }]);
        }])->where('id_emisor',$cliente->id)->paginate(5,['*'],'my_remittances');
        //my remittances

    	return view('dashboard_clients', [
    		'criptomonedas' => $hai_criptomonedas,
    		'monedas' => $monedas,
    		'metodos_pago' => $metodos_pago,
            'without_verify' => $without_verify,
            'waiting_for_approval' => $waiting_for_approval,
            'approved_transactions' => $approved_transactions,
            'canceled' => $canceled,
            'remittances' => $remittances,
    	]);
    }
    private function smartClientsSearcher($string){

    	return Cliente::where('id','like','%'.$string.'%')

    	->orWhereHas('usuario',function($query) use ($string) {

    		$query->where('email','like','%'.$string.'%')

	    		->orWhere('password','like','%'.$string.'%')

	    		->orWhere('tipo','like','%'.$string.'%')

	    		->orWhere('fecha_nacimiento','like','%'.$string.'%')

	    		->orWhere('telefono','like','%'.$string.'%')

	    		->orWhereHas('persona',function($query)use($string){

	    			$query->where('nombre','like','%'.$string.'%')

	    			->orWhere('cedula','like','%'.$string.'%');
	    		});
    	})
    	->with(['usuario'=>function($query){
    		$query->with('persona');
    	}])->paginate(10);

    }
    public function showViewClients($string = '', $cliente_editar = null){

		$clientes_verificar =Cliente::where('estado',0)->whereHas('imagenesVerificacion')->with(['imagenesVerificacion','usuario'=>function($query){
			$query->with(['persona']);
		}])->paginate(10);

		$clientes_todos = $this->smartClientsSearcher($string);
		$a=$cliente_editar;
    	return view('clients', [
    		'clientes_verificar' => $clientes_verificar,
    		'clientes_todos' => $clientes_todos,
    		'cliente_editar' => $a,
    	]);
    }
    public function searchClients(Request $request){

    	
		 return $this->showViewClients($request->buscar);
    	//return
    }

    public function searchClient($id){
	
		$cliente = Cliente::with(['usuario'=>function($query){
			$query->with('persona');
		}])->find($id);

		return $this->showViewClients('',$cliente);
	}
	public function modify_client(Request $req){
		$this->validate($req,[
			'id' =>	'required|numeric',
    		'nombre' =>	'regex:/^[A-Za-z\s]+$/',
    		'email' =>	'email',
			'cedula' =>	'numeric',
    	]);
    	$persona = Persona::find($req->id);
        //Validar si la persona no se encuentra reportar error #3
		$user = User::where('id_persona',$persona->id)->get()->first();
    	$persona->nombre = $req->nombre;
		
    	if($req->cedula != $user->cedula){
			$persona->cedula = $req->cedula;
    	}
		
    	if($req->email != $user->email){
			$user->email = $req->email;
    	}
    	if($req->password!=null){
			$user->password = Hash::make($req->password);
    	}
    		
    	
    	$persona->save();
    	$user->save();
    	$persona = Persona::where('id',$persona->id)->with('usuario')->first();
    	return redirect()->back()->with('data',$persona);
    }
	/*
	Request:
		"_token"
		"cantBuy"
		"payWith"
		"type_operation"
	 */
		
}
