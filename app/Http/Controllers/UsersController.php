<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Cliente;
use App\Transaccion;
use App\Deposito;
use App\CompraCriptomoneda;
use App\Remesa;
use App\Retiro;
use App\Moderador;
use App\User;
use App\DeletedUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function showViewUsers(){
    	return view('auth.users');
    }
    public function showViewDisabledUsers(){
    	return view('auth.disabled_users');
    }
/*

    public function search_user($cedula){
    }
*/
    public function editUser(Request $request){
        

        $request->validate([
            'id_user' => [],

            'nombre' =>  'required|regex:/^[A-Za-z\s]+$/',
            'esta_activo' => 'required|in:0,1',
            'esta_verificado' => 'required|in:0,1',
        ]);

        $user = User::with('persona')->find($request->id_user);


        if($request->email != $user->email){
            $request->validate([
                'email' =>  'required|email|unique:users,email',
            ]);
            $user->email = $request->email;
        }
        
        if($request->telefono != $user->telefono){

            $request->validate([
                'telefono' =>  'nullable|numeric|unique:users,telefono',
            ]);

            $user->telefono = $request->telefono;
        }
        if($request->cedula != $user->persona->cedula){

            $request->validate([
                'cedula' =>  'required|digits_between:1,20|unique:personas,cedula',
            ]);

            $user->persona->cedula = $request->cedula;
            
        }
        $user->persona->nombre = $request->nombre;

        $user->estado = $request->esta_activo;

        $user->verificado = $request->esta_verificado;

        $user->push();
        
        if($request->esta_activo == 0 && $user->tipo == 2){

            $user->moderador->otorgarTareas('turno_cliente', Cliente::class);
            $user->moderador->otorgarTareas('turno_compra', CompraCriptomoneda::class);
            $user->moderador->otorgarTareas('turno_remesa', Remesa::class);
            $user->moderador->otorgarTareas('turno_deposito', Deposito::class);
            $user->moderador->otorgarTareas('turno_retiro', Retiro::class);

        }

        return redirect()->back()->with([
            'Messages' => [
                'Changes saved successfuly'
            ]
        ]);

    }
    public function seeUser($id){
        $user = User::with('persona')->find($id);
        return view('auth.see_user',['user' => $user]);

    }
    public function create_user(Request $req){

    	$this->validate($req,[
    		'name' => 'required|regex:/^[A-Za-z\s]+$/',
    		'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|numeric|unique:users,telefono',
    		'id' => 'required|digits_between:1,20|unique:personas,cedula',
    		'password' => 'required',
    		'rol' => ['required',Rule::in(['2','3'])],
    		'date' => 'required|date',
    	]);

    	$persona = Persona::create([
    		'nombre' => $req->name,
    		'cedula' => $req->id,
    	]);

    	$user = User::create([
    		'id_persona' => $persona->id,
    		'email' => $req->email,
            'telefono' => $req->phone,
    		'password' => Hash::make($req->password),
    		'tipo' => $req->rol,
    		'fecha_nacimiento' => $req->date
    	]);
    	
        if($req->rol == 2){
            Moderador::create([
                'id_usuario'=> $user->id
            ]);
        }


    	return redirect()->back()->with('messages',[
    		'success' => 'User registered successfuly'
    	]);
    }

    public function searchUser(Request $request){
        $users = User::smartSearcher($request->string)->paginate(10);
        if(count($users)==0){
            $message = 'Users not found';
        }else{
            $message = 'Users found';
        }
        session()->flash('messages',[
            $message
        ]);
        return view('auth.users',[
            'users' => $users
        ]);

    }
    
    public function changeState(Request $req){

    	$this->validate($req,[
    		'user_to_change_state' => 'required|numeric',
    		'state' => 'required|numeric|in:1,2'
    	]);
    	$user = User::where('id_persona',$req->user_to_change_state)->first();
    		
    	if($user != null){

    		if($req->state == 3){
    			$user->estado = $req->state;
    		}else{
	    		$user->estado = $req->state;
    		}
	    	$user->save();
    		$persona = Persona::where('id',$req->user_to_change_state)->with('usuario')->first();
	    	session()->flash('data',$persona);
	    	return redirect()->back()->with('messages',[
	    		'disabled_success' => 'User disabled successfuly'
	    	]);
    	}else{
    		//Reportar error #2
    	}
    }
    public function main(){
        return view('welcome');
    }
    public function modifyUser(Request $req){
    	$this->validate($req,[

    		'name' => 'regex:/^[A-Za-z\s]+$/',
    		'email' => 'email', 
    		'id' => 'digits_between:1,20',
    		'rol' => [Rule::in(['2','3'])],
    		'date' => 'date',

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
    	$user->fecha_nacimiento = $req->fecha_nacimiento;
    	$user->tipo = $req->id_rol;
    	$persona->save();
    	$user->save();
    	$persona = Persona::where('id',$persona->id)->with('usuario')->first();
    	return redirect()->back()->with('data',$persona);

    }
    
}
