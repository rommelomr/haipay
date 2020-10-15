<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Moneda;
use Illuminate\Support\Facades\DB;

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
        })->orderBy('created_at','DESC')->paginate(8);
        
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
    public static function buyCrypto(
        $client_id,
        $transaction_type,
        $base,
        $pay_id,
        $amount,
        $price_crip_to_buy,
        $price_coin_to_pay,
        $type_operation,
        $comision_general,
        $other_comission,
        $total_sin_comision,
        $total_con_comision,
        $type){
        $transaction = Transaccion::create([
            'id_cliente' => $client_id,
            'id_tipo_transaccion'=>$transaction_type,
        ]);
        
        $compra_criptomoneda = CompraCriptomoneda::create([

            'id_hai_criptomoneda' => $base,

            'id_moneda' => $pay_id,

            'monto' => $amount,

            'precio_moneda_a_comprar' => $price_crip_to_buy,

            'precio_moneda_a_pagar' => $price_coin_to_pay,

            'id_metodo_pago' => $type_operation,

            'id_transaccion' => $transaction->id,

            'comision_general' => $comision_general,

            //'comision_compra' => $other_comission,

            'total_sin_comision' => $total_sin_comision,

            'ganancia' => $total_con_comision-$total_sin_comision,

            'total_con_comision' => $total_con_comision,

        ]);

        if($type == 'd'){

            DB::table('compras_generales')->insert([

                'id_compra_criptomoneda' => $compra_criptomoneda->id,

                'comision_compra' => $other_comission,

            ]);

        }else if($type == 'g'){

            DB::table('compras_generales')->insert([

                'id_compra_criptomoneda' => $compra_criptomoneda->id,

                'comision_compra' => $other_comission,

            ]);

        }
    }
    
}
