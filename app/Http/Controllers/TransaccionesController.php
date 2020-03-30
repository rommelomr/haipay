<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaccionesController extends Controller
{
    public function showViewTransactions(){
    	return view('transactions');
    }
    public function eliminarTransaccion(Request $request){
    	dd($request->all());
    }
    
}
