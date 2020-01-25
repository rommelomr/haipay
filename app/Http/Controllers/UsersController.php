<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
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
    public function create_user(Request $req){

    	$this->validate($req,[
    		'name' => 'required|regex:/^[A-Za-z\s]+$/',
    		'email' => 'required|email|unique:users', 
    		'id' => 'required|digits_between:1,20|unique:personas',
    		'password' => 'required',
    		'rol' => ['required',Rule::in(['2','3'])],
    		'date' => 'required|date',
    	]);


    	$persona = Persona::create([
    		'nombre' => $req->name,
    		'cedula' => $req->id,
    	]);

    	User::create([
    		'id_persona' => $persona->id,
    		'email' => $req->email,
    		'password' => Hash::make($req->password),
    		'tipo' => $req->rol,
    		'fecha_nacimiento' => $req->date
    	]);
    	


    	return redirect()->back()->with('messages',[
    		'success' => 'User registered successfuly'
    	]);
    }

    public function search_user($cedula = null){
    	if($cedula != null){

    		$ced = $cedula;
    	}else{
    		if(isset($_GET['buscar'])){
    			$ced = $_GET['buscar'];
    		}else{
    			//error inesperado #1
    		}
    	}
    		if(1){
		    	$persona = Persona::where('cedula',$ced)->with('usuario')->first();
		    	if($persona != null && $persona->usuario->tipo !== 1){

		    		return redirect()->back()->with('data',$persona);
		    	}else{
		    		return redirect()->back()->with('messages',[
		    			'user' => 'User not found']);
		    	}
		    	
    		}else{
    			//error inesperado #1
    		}

    }
    public function changeState(Request $req){

    	$this->validate($req,[
    		'user_to_change_state' => 'required|numeric',
    		'state' => 'required|numeric'
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
