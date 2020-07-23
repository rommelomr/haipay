<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use App\Criptomoneda;
use App\Remesa;
use App\Persona;
use App\RemesaCliente;
use App\RemesaNoUsuario;
use App\NoUsuario;
use App\MetodoPago;
use App\MetodoRetiro;
use Auth;
use App\Comision;

class RemesasController extends Controller
{

    public function confirmarRemesa(Request $req){ 
        $validations = $req->makeArrayToValidate(Remesa::class,[
            'cedula' => 'receivers_id',
            'monto' => 'amount_to_send',
            'nombre' => 'receivers_name',
            'id_tipo_operacion' => 'payment_method',
            'id_metodo_retiro' => 'retirement_method',
            
        ]);  
        $req->validate($validations);

        $metodo_retiro = MetodoRetiro::find($req->retirement_method);
        $metodo_pago = MetodoPago::find($req->payment_method);
        $comisiones = Comision::getComisiones(['general','buy 1','buy 2','buy 3']);


        $precio_btc = Criptomoneda::consultarPrecioMoneda([

            'siglas' => 'BTC'
        ]);

        $precio_htg = Criptomoneda::consultarPrecioPar([

            'buy' => 'BTC',
            'pay' => 'HTG',
        ]);

        $comisiones = Comision::getComisiones(['general','buy 1','buy 2','buy 3']);
        
        $comision_general = $comisiones['general']['porcentaje'];

        unset($comisiones['general']);

        $comision_compra = Remesa::seleccionarComisionCompra($req->amount_to_send,$comisiones);

        $htg_to_deliver = Remesa::calculateHtg($req->amount_to_send,[
            'general'   => $comision_general,
            'compra'    => $comision_compra
        ],$precio_btc,$precio_htg);

        return view('remittances.confirm_remittance',[

            'receivers_id' => $req->receivers_id,
            'amount_to_send' => $req->amount_to_send,
            'htg_to_deliver' => $htg_to_deliver,
            'receivers_name' => $req->receivers_name,
            'payment_method' => [
                'id' => $metodo_pago->id,
                'nombre' => $metodo_pago->nombre,
            ],
            'retirement_method' => [
                'id' => $metodo_retiro->id,
                'nombre' => $metodo_retiro->nombre,
            ],
        ]);
    }
    public function changeStateRemittance(Request $req){
        $req->validate([
            'id_remesa' => ['required','exists:remesas,id']
        ]);

    }
    public function seeRemittance($id){
        $remesa = Remesa::with([
            'emisor'=>function($query){
                $query->with([
                    'usuario'=>function($query){
                        $query->with('persona');
                    }
                ]);
            }
            ,'remesaInterna'=>function($query){
                $query->with([
                    'cliente'=>function($query){
                        $query->with([
                            'usuario'=>function($query){
                                $query->with('persona');
                            }
                        ]);
                    }
                ]);
            }
            ,'remesaExterna'=>function($query){
                $query->with([
                    'noUsuario'=>function($query){
                        $query->with('persona');
                    }
                ]);
            }
            ,'metodoRetiro'
        ])->where('id',$id)->firstOrFail();

        return view('remittances.ver_remesa',[
            'remesa'=>$remesa
        ]);
    }
    public function searchRemittances(Request $req){

        $remesas = Remesa::smartSearcher($req->string);
        dd($remesas);

    }
    public function showAllRemittancesView(){
        $remesas = Remesa::whereHas('transaccion',function($query){
            $query->where('estado',1);

        })->with([
            'emisor'=>function($query){
                $query->with([
                    'usuario'=>function($query){
                        $query->with('persona');
                    }
                ]);
            }
            ,'remesaInterna'=>function($query){
                $query->with([
                    'cliente'=>function($query){
                        $query->with([
                            'usuario'=>function($query){
                                $query->with('persona');
                            }
                        ]);
                    }
                ]);
            }
            ,'remesaExterna'=>function($query){
                $query->with([
                    'noUsuario'=>function($query){
                        $query->with('persona');
                    }
                ]);
            }
            ,'metodoRetiro'
        ])->paginate(25);
        return view('remittances.listar_remesas',[
            'remesas' => $remesas
        ]);
    }

    //USERS
    public function verifyRemittances(){
        $remesas = Remesa::getRemesa(null);
        
        return view('remittances.verify_remittances',[
            'remesas' => $remesas,
            'selected_button' => 0,
            'title' => 'Verify remittances'
        ]);
    }
    public function waitingRemittances(){
        $remesas = Remesa::getRemesa(0);
        
        return view('remittances.verify_remittances',[
            'remesas' => $remesas,
            'selected_button' => 1,
            'title' => 'Remittances waiting form approval'
        ]);
    }
    public function approvedRemittances(){
        $remesas = Remesa::getRemesa(1);
        
        return view('remittances.verify_remittances',[
            'remesas' => $remesas,
            'selected_button' => 2,
            'title' => 'Approved remittances'
        ]);
    }
    public function canceledRemittances(){
        $remesas = Remesa::getRemesa(2);
        
        return view('remittances.verify_remittances',[
            'remesas' => $remesas,
            'selected_button' => 3,
            'title' => 'Canceled remittances'
        ]);
    }
    
    
    

    public function showRemittancesView(Request $req){

        $metodos_pago =MetodoPago::all();

        //Verify_pyments
        $cliente = \Auth::user()->cliente;

        //Remesa sin imagen
        $pending_remittances = Remesa::obtenerRemesa($cliente,null)->paginate(5,['*'],'pending_remittances');

        //Remesa con imagen esperando por aprobación
        $for_approval_remmitances = Remesa::obtenerRemesa($cliente,0)->paginate(5,['*'],'for_approval_remmitances');

        //Remesa con imagen aprobada
        $approved_remittances = Remesa::obtenerRemesa($cliente,1)->paginate(5,['*'],'approved_remittances');

        //Remesa con imagen rechazada
        $refused_remittances = Remesa::obtenerRemesa($cliente,2)->paginate(5,['*'],'refused_remittances');

        $retirement_methods = MetodoRetiro::all();


        return view('remittances.enviar_remesas',[
            'metodos_pago' => $metodos_pago,
            'cliente' => $cliente,
            'pending_remittances' => $pending_remittances,
            'for_approval_remmitances' => $for_approval_remmitances,
            'approved_remittances' => $approved_remittances,
            'refused_remittances' => $refused_remittances,
            'retirement_methods' => $retirement_methods,
        ]);
    }
    public function enviarRemesa(Request $req){

        //Se valida la entrada del formulario
        $validations = $req->makeArrayToValidate(Remesa::class,[
            'cedula' => 'receivers_id',
            'monto' => 'amount_to_send',
            'nombre' => 'receivers_name',
            'id_tipo_operacion' => 'payment_method',
            'id_metodo_retiro' => 'retirement_method',
            
        ]);
        //dd($validations);
        
        $req->validate($validations);

    //consultar a la persona por cédula
    //Si no existe: 
        //Crear la persona (quedará el campo nombre vacio. es_usuario = 0)
        //Agregar un nuevo No Usuario con el ID de esa persona nueva
        //Crear Transaccion
        //Crear Remesa
        //dd(Persona::where('cedula',$req->receivers_id)->exists());
        $persona_existe = Persona::where('cedula',$req->receivers_id)->exists();
        $auth = Auth::user();
        if($persona_existe){

            $receptor_persona = Persona::where('cedula',$req->receivers_id)->with([
                'usuario'=>function($query){
                    $query->with('cliente');
                }
                ,'noUsuario'
            ])
            ->first();

        }else{

            //Se registra la persona
            $receptor_persona = Persona::create([
                'nombre' => $req->receivers_name,
                'cedula' => $req->receivers_id,
                'es_usuario' => 0
            ]);

            //Se registra el no usuario
            $receptor_no_usuario = NoUsuario::create([
                'id_persona' => $receptor_persona->id,
                'id_anfitrion' => $auth->id
            ]);            

        }
        if($receptor_persona->es_usuario){
            $tipo_transaccion = 1;
        }else{

            $tipo_transaccion = 2;

        }
        
        //Se crea la transaccion
        $transaccion = Transaccion::create([

            'id_cliente'            => $auth->cliente->id,
            'id_tipo_transaccion'   => $tipo_transaccion, //2 = external remittance
        ]);

        $precio_btc = Criptomoneda::consultarPrecioMoneda([

            'siglas' => 'BTC'
        ]);

        $precio_htg = Criptomoneda::consultarPrecioPar([

            'buy' => 'BTC',
            'pay' => 'HTG',
        ]);

        $comisiones = Comision::getComisiones(['general','buy 1','buy 2','buy 3']);
        
        $comision_general = $comisiones['general']['porcentaje'];

        unset($comisiones['general']);

        $comision_compra = Remesa::seleccionarComisionCompra($req->amount_to_send,$comisiones);

        $htg_to_deliver = Remesa::calculateHtg($req->amount_to_send,[
            'general'   => $comision_general,
            'compra'    => $comision_compra
        ],$precio_btc,$precio_htg);

/*
        if($req->amount_to_send <100){

            $comision_compra = $comisiones['buy 1']['porcentaje'];
        }else if($req->amount_to_send < 400){

            $comision_compra = $comisiones['buy 2']['porcentaje'];
        }else{

            $comision_compra = $comisiones['buy 3']['porcentaje'];
        }

        $amount_sus_general = $req->amount_to_send;

        $amount_sus_general -= $req->amount_to_send * ($comisiones['general']['porcentaje']/100);

        $amount_sus_buy = $amount_sus_general;

        $amount_sus_buy -= $req->amount_to_send * ($comision_compra/100);

        $htg_to_deliver = ($amount_sus_buy / $precio_btc) * $precio_htg;
*/

        $tipo_remesa = 2;

        $remesa = Remesa::create([

            'id_emisor'=> $transaccion->id_cliente,

            'id_transaccion'=> $transaccion->id,

            'id_metodo_retiro'=> $req->retirement_method,

            'id_tipo_remesa'=> $tipo_remesa,

            'id_metodo_pago'=> $req->payment_method,

            'monto'=> $req->amount_to_send,

            'comision_general'=> $comision_general,

            'comision_compra'=> $comision_compra,

            'precio_bitcoin_htg'=> $precio_htg,

            'monto_total'=> $htg_to_deliver,

        ]);

        if($persona_existe && $receptor_persona->es_usuario){

            RemesaCliente::create([
                'id_remesa' => $remesa->id,
                'id_cliente' => $receptor_persona->usuario->cliente->id
            ]);

        }else{

            if($persona_existe){

                $no_user_id = $receptor_persona->noUsuario->id;

            }else{

                $no_user_id = $receptor_no_usuario->id;

            }
            RemesaNoUsuario::create([
                'id_remesa' => $remesa->id,
                'id_no_usuario' => $no_user_id
            ]);
        }


        return redirect()->route('remittances')->with([
            'messages'=>[
                'Remittance sent succesfuly. Now, you must verify it'
            ]
        ]);
    }
    public function verificarRemesa(Request $req){
        
    }
    
    public function eliminarTransaccion(Request $req){
        dd($req->all());
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
