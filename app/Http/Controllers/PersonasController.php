<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cartera;
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
        $carteras = Cartera::with(['haiCriptomoneda'=>function($query){
            $query->with('moneda');
        }])->where('id_cliente',$data->cliente->id)->paginate(10);
        //Validar si es admin o moderador no aplican los mensajes de cuenta verificada o no

    	return view('auth.edit_profile',[
    		'current_user_data' => $data,
            'incompleted_profile' => $incompleted_profile,
            'account_verified' => $account_verified,
            'carteras' => $carteras,
    	]);
    }
    public function saveProfile(Request $req){
        $this->validate($req,[
    		'password' => 'required',
            'old_password' => 'required',
    	]);

    	$user = Auth::user();

        $persona = $user->persona;

        if(Hash::check('plain-text',$req->old_password)){

        	$user->password = Hash::make($req->password);

        	$user->push();

            $message = "Password changed succesfuly";

        }else{

            $message = "The old password is not valid";

        }
    	
    	return redirect()->back()->with([
            'messages'=>[
                $message
            ]
        ]);
    }
    private function verifyUser(){
        
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
        //$idCliente = Auth::user()->cliente->id;
        $user = Auth::user();
        $client = $user->cliente;
        if($request->file0!=null){
            $this->createImagenVerificacion($client->id, $this->guardarDocumentos($request->file('file0'), $client->id,'ID'),0);
        }
        if($request->file1!=null){
            $this->createImagenVerificacion($client->id, $this->guardarDocumentos($request->file('file1'), $client->id,'date'),1);
        }
        $this->verifyUser($user);
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
