<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteVideo extends Model
{
	protected $guarded = [];
    public function cliente(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }
    public function video(){
    	return $this->belongsTo('App\Video','id_video');
    }
    
}
