<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonasController extends Controller
{
    public function showViewEditProfile(){
    	return view('auth.edit_profile');
    }
}
