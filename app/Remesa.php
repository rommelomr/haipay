<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Persona;

class Remesa extends Model
{
    protected $table = 'remesas';
    protected $guarded = [];
    public function getValidations($req){
        //return $this->validations;
        return [

            'cedula' => 'required|digits_between:1,20',

            'nombre' => [Rule::requiredIf(function()use($req){
                $persona = Persona::where('cedula',$req->receivers_id)->first();
                if($persona == null){

                    return true;
                }else{

                    return false;
                }
            }),'regex:/^[A-Za-z\s]+$/'],

            'monto' =>  'required|numeric',

            'id_tipo_operacion' => 'required|exists:metodos_pago,id',

            'id_metodo_retiro' => 'required|exists:metodos_retiro,id',


        ];
    }
    public static function modify($remesa,$remesa_attrs_to_change,$request){
        
        foreach($remesa_attrs_to_change as $key => $value){

            $remesa->$key = $request->$value;
        }
        return $remesa;
    }
    public function smartSearcher($string){

        $remesas = Remesa::where(function($query)use($string){
            $query->where('created_at','like','%'.$string.'%')
            ->orWhereHas('emisor',function($query)use($string){
                $query->whereHas('usuario',function($query)use($string){
                    $query->whereHas('persona',function($query)use($string){
                        $query->where('nombre','like','%'.$string.'%')
                        ->orWhere('cedula','like','%'.$string.'%');
                    });
                });
            });
        });

        return $remesas;

    }
    public static function getRemesa($type){

       return Remesa::with([
            'remesaExterna'=>function($query){
                $query->with([
                    'noUsuario'=>function($query){
                        $query->with(['persona']);
                    }
                ]);

            },
            'remesaInterna'=>function($query){
                $query->with([
                    'cliente'=>function($query){
                        $query->with([
                            'usuario'=>function($query){
                                $query->with('persona');
                            }
                        ]);
                    }
                ]);

            }
        ])->whereHas('transaccion',function($query)use($type){
            $auth = \Auth::user();
            $query->where('id_cliente',$auth->cliente->id)
            ->where('estado',$type);
        })->orderBy('created_at','DESC')->paginate(8);
     
    }
    public static function seleccionarComisionCompra($amount_to_send,$comisiones){
        if($amount_to_send <100){

            return $comisiones['buy 1']['porcentaje'];
        }else if($amount_to_send < 400){

            return $comisiones['buy 2']['porcentaje'];
        }else{

            return $comisiones['buy 3']['porcentaje'];
        }
    }
    public static function calculateHtg($amount_to_send,$comisiones,$precio_btc,$precio_htg){

        $amount_sus_general = $amount_to_send;

        $amount_sus_general -= $amount_to_send * ($comisiones['general']/100);

        $amount_sus_buy = $amount_sus_general;

        $amount_sus_buy -= $amount_to_send * ($comisiones['compra']/100);

        return round((($amount_sus_buy / $precio_btc) * $precio_htg)*100)/100;

    }
    
    public function emisor(){
    	return $this->belongsTo(Cliente::class,'id_emisor');
    }

    public function remesaInterna(){

        return $this->hasOne(RemesaCliente::class,'id_remesa');
    }
    public function remesaExterna(){

        return $this->hasOne(RemesaNoUsuario::class,'id_remesa');
    }
    public function transaccion(){
    	return $this->belongsTo(Transaccion::class,'id_transaccion');
    }
    public function metodoRetiro(){
        return $this->belongsTo('App\MetodoRetiro','id_metodo_retiro');
    }
    public static function obtenerRemesa($cliente,$estado){

        return Remesa::whereHas('transaccion',function($query)use($estado){
            $query->where('estado',$estado);
        })->with(['remesaInterna'=>function($query){
            $query->with(['cliente'=>function($query){
                $query->with(['usuario'=>function($query){
                    $query->with('persona');
                }]);
            }]);
        },'remesaExterna'=>function($query){
            $query->with(['noUsuario'=>function($query){
                $query->with('persona');
            }]);
        },'transaccion'=>function($query){
            $query->with('imagen');
        }])->where('id_emisor',$cliente->id)->orderBy('created_at','DESC');
    }
    
}
