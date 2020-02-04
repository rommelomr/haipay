<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ImagenVerificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PersonasController extends Controller
{
    public function showViewEditProfile(){
    	
    	$data = User::with(['persona','cliente'=>function($query){
            $query->with('imagenesVerificacion');
        }])->where('id_persona',\Auth::user()->id_persona)->first();

        //dd($data->telefono == null);
        if(($data->persona->cedula == null )|| ($data->telefono == null)){
            $incompleted_profile = true;
        }else{
            $incompleted_profile = false;
        }

        $imagenes = $data->cliente->imagenesVerificacion;
        $account_verified = true;

        if($imagenes == null || (count($imagenes)!=2)){
            $account_verified = false;
        }else{
            foreach ($imagenes as $value){
                if(($value->estado === 0) || ($value->estado === 2)){
                    $account_verified = false;
                }
            }
        }
        //Validar si es admin o moderador no aplican los mensajes de cuenta verificada o no

    	return view('auth.edit_profile',[
    		'current_user_data' => $data,
            'incompleted_profile' => $incompleted_profile,
            'account_verified' => $account_verified,
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
        $messages = [
            'file0.required' => 'Debe enviar una imagen de su cedula',
            'file1.required' => 'Debe enviar una imagen de la fecha del dia de hoy',
        ];
        $request->validate([
            'file0' => ['bail',Rule::requiredIf(function() use ($request){
                return $request->file1 == null;
            }),'image','max:7680'],
            'file1' => ['bail',Rule::requiredIf(function() use ($request){
                return $request->file0 == null;
            }),'image','max:7680'],
            
            //'file1' => 'required|image|max:7680',
        ],$messages);
        $idCliente = Auth::user()->cliente->id;
        if($request->file0!=null){
            $this->createImagenVerificacion($idCliente, $this->guardarDocumentos($request->file('file0'), $idCliente,'ID'),0);
        }
        if($request->file1!=null){
            $this->createImagenVerificacion($idCliente, $this->guardarDocumentos($request->file('file1'), $idCliente,'date'),1);
        }

        return redirect()->back();
    }
    
    private function guardarDocumentos($file, $idCliente ,$typeDocument){
        
        $name=$typeDocument.'_'.auth::user()->cliente->id;
        $file->storeAs('public', $name.'.'.explode(".",$file->getClientOriginalName())[1]);
        return $name.'.'.explode(".",$file->getClientOriginalName())[1];
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
