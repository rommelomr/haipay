<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ImagenVerificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PersonasController extends Controller
{
    public function showViewEditProfile(){
    	
    	$data = User::with(['persona','imagenes'])->where('id_persona',\Auth::user()->id_persona)->first();

        if(($data->cedula == null )|| ($data->telefono == null)){
            $incompleted_profile = true;
        }else{
            $incompleted_profile = false;
        }

        if($data->imagenes == null){
            $incompleted_profile = true;
        }else{
            $incompleted_profile = false;
        }

    	return view('auth.edit_profile',[
    		'current_user_data' => $data,
            'incompleted_profile' => $incompleted_profile,
    	]);
    }
    public function saveProfile(Request $req){
        $this->validate($req,[
    		'nombre' => 'required|regex:/^[A-Za-z\s]+$/',
    		'cedula' => 'required|digits_between:1,20',
    		'email' => 'required|email', 
    		'telefono' => 'required|digits_between:1,20',
    	]);
    	$user = Auth::user();
        $persona = $user->persona;

        if($req->nombre != $user->nombre){
    	    $persona->nombre = $req->nombre;
        }

    	if($req->cedula != $user->cedula){
    		$persona->cedula = $req->cedula;
    	}

    	if($req->email != $user->email){
    		$user->email = $req->email;
        }

        if($req->telefono != $user->telefono){
    		$user->telefono = $req->telefono;
        }
        
    	if($req->password!=null){
    		$user->password = Hash::make($req->password);
        }
        
    	$persona->save();
    	$user->save();
    	
    	return redirect()->back();
    }

    public function file_Verify(Request $request){
        $this->validate(request(), [
            'file' => 'required|image|max:7680',
            'file2' => 'required|image|max:7680',
        ]);

        $idCliente = auth::user()->cliente->id;
        //dd($this->guardarDocumentos($request->file('file'), $idCliente,'ID'))   ;
        $this->createImagenVerificacion($idCliente, $this->guardarDocumentos($request->file('file'), $idCliente,'ID'),0);
        $this->createImagenVerificacion($idCliente, $this->guardarDocumentos($request->file('file2'), $idCliente,'date'),1);

        return redirect()->back();
    }
    
    private function guardarDocumentos($file, $idCliente ,$typeDocument){
        $name=$typeDocument.'_'.auth::user()->cliente->id;
        $file->storeAs('public', $name.'.'.explode(".",request()->file->getClientOriginalName())[1]);
        return $name.'.'.explode(".",request()->file->getClientOriginalName())[1];
    }

    private function createImagenVerificacion($idCliente, $ruta,$tipo){
        $consulta = ImagenVerificacion::where('id_cliente',$idCliente)->where('tipo',$tipo)->first();
        if($consulta == null)
            ImagenVerificacion::create([
                'id_cliente' => $idCliente,
                'nombre' => $ruta,
                'tipo' => $tipo,
            ]);
        else{
            $consulta->nombre = $ruta;
            $consulta->save();
        }
    }

}
