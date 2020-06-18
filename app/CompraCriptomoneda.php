<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Moneda;

class CompraCriptomoneda extends Model
{
	protected $table = 'compras_criptomoneda';
    protected $guarded = [];
    public static function getCompras($type){

        return CompraCriptomoneda::with([
            'haiCriptomoneda' => function($query){
                $query->with('moneda');
            },
            'moneda',
            'transaccion'
        ])
        ->whereHas('transaccion',function($query)use($type){
            $auth = \Auth::user();
            $query->where('id_cliente',$auth->cliente->id)
            ->where('estado',$type);
        })->paginate(8);
        
    }
    public function haiCriptomoneda(){
    	return $this->belongsTo('App\HaiCriptomoneda','id_hai_criptomoneda');
    }
    public function transaccion(){
        return $this->belongsTo('App\Transaccion','id_transaccion');
    }
    
 	public function moneda(){
        return $this->belongsTo('App\Moneda','id_moneda');
    }
    public static function cargarPar($pair){
        $crypto_pair = explode('-',$pair);

        $crypto_arr = [];
        $i = 0;
        if(count($crypto_pair) == 2){

        	foreach ($crypto_pair as $key => $value){


        		$crypto = Moneda::where('siglas',$value)->firstOrFail();

        		$crypto_arr[$i]['data']=$crypto;
                
                $crypto_arr[$i++]['dolar_price'] = (float)Moneda::consultarPrecioMoneda([
                    'id' => $crypto->id,
                    'siglas' => $crypto->siglas,
                ]);
        	};
        	return $crypto_arr;

        }else{

        	abort(404);
        }
        
        
    }
    
}
