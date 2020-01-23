<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\User;
use App\Cliente;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    public function showDashboard(){
    	return view('dashboard_clients');
    }
    public function showViewClients(){
		$clientes =Cliente::all();
    	return view('clients', array('clientes' => $clientes));
    }

    public function search_client($cedula = null){
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
			
			if($persona != null && $persona->usuario->tipo == 1){
				return redirect()->back()->with('data',$persona);
			}else{
				return redirect()->back()->with('messages',[
					'user' => 'User not found']);
		    	}
		    	
    		}else{
				//error inesperado #1
    		}
			
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
	
}
