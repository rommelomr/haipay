<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    public function saveProfile(Request $request){
    	/*
    		Llegan:
	    		nombre
	    		email
	    		password
	    		telefono

    	*/
    	dd($request->all());
    }

}
