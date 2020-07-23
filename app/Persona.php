<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $validations = [

        'id' => ['exists:personas,id','required'],
        'nombre' => ['regex:/^[A-Za-z\s]+$/','required'],

    ];
    public function getValidations(){
        return $this->validations;
    }
    public static function modify($remesa,$remesa_attrs_to_change,$request){
        
        foreach($remesa_attrs_to_change as $key => $value){

            $remesa->$key = $request->$value;
        }
        return $remesa;
    }
	protected $guarded = [];
    public function usuario(){
    	return $this->hasOne('App\User','id_persona');
    }
    public function noUsuario(){
        return $this->hasOne('App\NoUsuario','id_persona');
    }
    
    public function receptor(){
    	return $this->hasOne('App\Receptor','id_persona');
    }
    
}
