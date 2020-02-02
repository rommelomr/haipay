<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}
