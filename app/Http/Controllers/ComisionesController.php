<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comision;
use App\HaiCriptomoneda;

class ComisionesController extends Controller
{
    public function updateNetworkComission(Request $request){

        $request->validate([
            'new_comission_value' => ['required','numeric','min:0.0001','max:100'],
        ]);

        $haicriptomoneda = HaiCriptomoneda::whereHas('moneda', function($query)use($request){
                $query->where('siglas',$request->new_comission_acr);
            }

        )->firstOrFail();

        $haicriptomoneda->comision_red = $request->new_comission_value;
        $haicriptomoneda->save();
        return redirect()->back()->with([
            'messsges'=>[
                'Network Comission updated successfully'
            ]
        ]);


    }
    public function updateComission(Request $request){

        $request->validate([
            'name_comission'    => ['required','in:General,Buy 1,Buy 2,Buy 3,Trade'],
            'value_comission'   => ['required','numeric','min:0','max:100']
        ]);

        $comision = Comision::where('nombre',$request->name_comission)->first();
        $comision->porcentaje = $request->value_comission;
        $comision->save();

        return redirect()->back()->with([
            'messages'=>[
                'Comission modified successfully'
            ]
        ]);

    }
    public function showComissionsView(){

    	$comisiones        = Comision::all();
        $hai_criptomonedas = HaiCriptomoneda::with('moneda')->get();

    	$arr_comisiones = [];

    	foreach($comisiones as $comision){

    		$arr_comisiones[strtolower($comision->nombre)] = [
    			'minimo'		=>	$comision->minimo,
    			'maximo'		=>	$comision->maximo,
    			'porcentaje'	=>	$comision->porcentaje,
    		];

    	}
    	return view('admin.comissions',[
    		'comisiones' => $arr_comisiones,
            'hai_criptomonedas' => $hai_criptomonedas
    	]); 
    }
}
