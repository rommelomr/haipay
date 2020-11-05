<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function generateRememberToken(){

        $token = '';

        for($i = 0; $i < 50; $i++){
            $token .= chr(rand(65,90));
        }

        return $token.strtotime('now');

    }

    public function updateRememberToken(){

        $this->remember_token = User::generateRememberToken();

    }
    
    public function updateMoncash(&$message,$req){

        if($req->moncash != null && $this->moncash != $req->moncash){

            $this->moncash = $req->moncash;
            $message[] = 'Moncash changed successfully';
        }


    }    
    public function updateTelefono(&$message,$req){

        $telefono_existe = 
            DB::table('historial_telefonos')
            ->where('telefono',$req->telefono)
            ->where('id_usuario',$this->id)
            ->exists();

        if(!$telefono_existe){

            DB::table('historial_telefonos')->insert([
                'telefono' => $req->telefono,
                'id_usuario' => $this->id
            ]);

            $this->telefono = $req->telefono;

            $message[] = 'Telephone changed successfully';
            
        }else{

        }


    }    
    public function updatePassword(&$message,$req){

        if($req->password != null){
            
            if(Hash::check($req->old_password,$this->password) ){

                $this->password = Hash::make($req->password);


                $message[] = "Password changed successfuly";

            }else{

                $message[] = "The old password is not valid";

            }
        }
        

    } 
    
    public function cliente(){
        return $this->hasOne('App\Cliente','id_usuario');
    }    
    public function moderador(){
        return $this->hasOne('App\Moderador','id_usuario');
    }    
    public function receptor(){
        return $this->hasOne('App\Receptor','id_usuario');
    }    
    public function acciones(){
        return $this->belongsToMany('App\Accion','auditorias','id_usuario','id_accion');
    }    
    public function auditorias(){
        return $this->hasMany('App\Auditorias','id_usuario');
    }    
    
    public function persona(){
        return $this->belongsTo('App\Persona','id_persona');
    } 
    public function imagenes(){
        return $this->belongsTo('App\ImagenVerificacion','id_cliente');
    }
    public static function smartSearcher($string){

        $users = User::where(function($query)use($string){
            $query->where('email','like','%'.$string.'%')
            ->orWhere('telefono','like','%'.$string.'%')
            ->orWhere('id','like','%'.$string.'%');

        })->orWhereHas('persona',function($query)use($string){

            $query->where('nombre','like','%'.$string.'%')
            ->orWhere('cedula','like','%'.$string.'%');
        })
        ->with(['persona']);
        return $users;
    }
    
}
