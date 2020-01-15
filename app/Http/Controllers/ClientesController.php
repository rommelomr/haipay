<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\User;

class ClientesController extends Controller
{
    public function showDashboard(){
    	return view('dashboard_clients');
    }
    public function showViewClients(){
    	return view('clients');
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
		    	if($persona->usuario != null && $persona->usuario->tipo === 1){

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
    	$persona = Persona::where('id',$req->id)->with('usuario')->first();
        if(1){
            
        }else{
            // Si la persona no se encuentra, error #4
        }
        dd($persona);

    	

    }

}
