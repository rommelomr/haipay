<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PersonasController extends Controller
{
    public function showViewEditProfile(){
    	
    	$data = User::with('persona')->where('id_persona',\Auth::user()->id_persona)->first();

    	return view('auth.edit_profile',[
    		'current_user_data' => $data
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
