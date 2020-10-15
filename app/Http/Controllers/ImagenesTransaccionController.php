<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImagenTransaccion;
use App\Transaccion;
use App\Cliente;
use App\Moderador;
use Illuminate\Support\Facades\Storage;

class ImagenesTransaccionController extends Controller
{
    private function saveImage($data){
        $data->validate([
            'id_transaction' => 'required|exists:transacciones,id',
            'file' => 'required|image|max:7680'
        ]);

        $name = time();

        $data->file('file')->storeAs('public',$name);

        return $name;
    }
    public function verifyPyment(Request $request){
        
        $transaccion = Transaccion::where('estado',null)
        ->where('id',$request->id_transaction)
        ->with([
            'compraCriptomoneda',
            'remesa',
        ])
        ->firstOrFail();

        $name = $this->saveImage($request);
        
        $transaccion->setModerator();
        
        $transaccion->push();

        ImagenTransaccion::create([
            'id_transaccion'=>$request->id_transaction,
            'nombre'=>$name
        ]);

        $transaccion->estado = 0;
        $transaccion->save();
        
        return redirect()->back();
    }
    public function resendImage(Request $request){
        $name = $this->saveImage($request);

        $transaccion = Transaccion::find($request->id_transaction);

        $moderador_turno = Moderador::obtenerModeradorDeTurno('turno_transaccion');
        $transaccion->id_moderador = $moderador_turno->id;
        $imagen = ImagenTransaccion::where('id_transaccion',$request->id_transaction)

        ->whereHas('transaccion',function($query){
            $user = \Auth::user();
            $cliente = Cliente::where('id_usuario',$user->id)->first();

            $query->where('id_cliente',$cliente->id)
            ->where('estado','<>',1);
        })
        ->with('transaccion')
        ->firstOrFail();

        Storage::delete('public/'.$imagen->nombre);
        $imagen->nombre = $name;
        $imagen->transaccion->estado = 0;
        $imagen->push();
        return redirect()->back();


    }
}