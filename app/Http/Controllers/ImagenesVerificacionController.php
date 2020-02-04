<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenesVerificacionController extends Controller
{
    public function verifyImage(Request $request){

    	dd($request->all());

    }
}
