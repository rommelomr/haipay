<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonasController extends Controller
{
    public function showViewEditProfile(){
    	
    	$data = User::with(['persona','imagenes'])->where('id_persona',\Auth::user()->id_persona)->first();

        if(($data->cedula == null )|| ($data->telefono == null)){
            $incompleted_profile = true;
        }else{
            $incompleted_profile = false;
        }

        if($data->imagenes == null){
            $incompleted_profile = true;
        }else{
            $incompleted_profile = false;
        }

    	return view('auth.edit_profile',[
    		'current_user_data' => $data,
            'incompleted_profile' => $incompleted_profile,
    	]);
    }
    public function saveProfile(Request $req){
        $this->validate($req,[
    		'nombre' => 'required|regex:/^[A-Za-z\s]+$/',
    		'cedula' => 'required|digits_between:1,20',
    		'email' => 'required|email', 
    		'telefono' => 'required|digits_between:1,20',
    	]);
    	$user = Auth::user();
        $persona = $user->persona;

        if($req->nombre != $user->nombre){
    	    $persona->nombre = $req->nombre;
        }

    	if($req->cedula != $user->cedula){
    		$persona->cedula = $req->cedula;
    	}

    	if($req->email != $user->email){
    		$user->email = $req->email;
        }

        if($req->telefono != $user->telefono){
    		$user->telefono = $req->telefono;
        }
        
    	if($req->password!=null){
    		$user->password = Hash::make($req->password);
        }
        
    	$persona->save();
    	$user->save();
    	
    	return redirect()->back();
    }

    public function file_Verify(){
    	dd(1);
    }

}
