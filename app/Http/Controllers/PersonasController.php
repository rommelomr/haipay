<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\User;
use App\Moderador;
use App\Cartera;
use App\ImagenVerificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PersonasController extends Controller
{
    public function consultarPorCedula(Request $request){

        $persona = Persona::where('cedula',$request->cedula)->first();

        if($persona == null){

            return json_encode([
                'status'    =>  0,
                'message'   =>  'There are no person registered with this ID',
            ]);

        }else{
            
            return json_encode([
                'status'    =>  1,
                'message'   =>  'Person found',
                'name'      =>  $persona->nombre
            ]);
        }


    }
    /*
    public function registerNoUser(Request $request){

        $array = Persona::makeArrayToValidate(Persona::class,[
            'id' => 'id_persona',
            'nombre' => 'full_name'
        ]);
        dd($array);
        $request->validate($array);


    }
    */
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

        $id = ImagenVerificacion::where('id_cliente',$data->cliente->id)->where('tipo',0)->first();
        $date = ImagenVerificacion::where('id_cliente',$data->cliente->id)->where('tipo',1)->first();
        
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
        $pestana = 0;
        if(isset($_GET['p'])){

            if($_GET['p'] == 1){
                $pestana = 1;
            }elseif($_GET['p'] == 2){
                $pestana = 2;
            }
        }
    	return view('auth.edit_profile',[
    		'current_user_data' => $data,
            'incompleted_profile' => $incompleted_profile,
            'account_verified' => $account_verified,
            'carteras' => $carteras,
            'pestana' => $pestana,
            'id' => $id,
            'date' => $date,
    	]);
    }
    public function saveProfile(Request $req){
        $this->validate($req,[
            'password' => [Rule::requiredIf(function()use($req){

                return $req->old_password != null;

            })],
            'moncash'  => ['nullable','digits_between:1,20'],
            'telefono'  => ['nullable','digits_between:1,20'],
    	]);
        
    	$user = Auth::user();

        $persona = $user->persona;
        $messages = [];
        $user->updateMoncash($messages,$req);
        $user->updateTelefono($messages,$req);
        $user->updatePassword($messages,$req);
        
        
       	$user->push();
    	
    	return redirect()->back()->with([
            'messages'=>$messages
        ]);
    }
    private function verifyUser(){
        
    }

    public function verifyClientImage(Request $request){

        $request->validate([
            'type' => ['required','in:0,1'],
            'picture' => ['required','image','max:7680']
        ]);
        
        $client = \Auth::user()->cliente;
        if($request->type == 0){
            $type = 'ID';
        }else{
            $type = 'date';

        }
        if($client->id_moderador == null){
            $moderador_turno = Moderador::obtenerModeradorDeTurno('turno_cliente');
            $client->id_moderador = $moderador_turno->id;
            $client->save();
        }
        $imagen = ImagenVerificacion::where('id_cliente',$client->id)->where('tipo',$request->type)->first();

        $this->createImagenVerificacion($client->id, $this->guardarDocumentos($request->file('picture'), $client->id,$type,$imagen),$request->type,$imagen);

        return redirect()->back()->with(['messages'=>[
            'Image uploaded successfuly'
        ]]);

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
    
    private function guardarDocumentos($file, $idCliente ,$typeDocument,$imagen){

        $extension = explode(".",$file->getClientOriginalName());
        $extension = $extension[count($extension)-1];

        $name=$typeDocument.'_'.auth::user()->cliente->id.'.'.$extension;

        if($imagen != null){
            
            Storage::delete('public/'.$imagen->nombre);
        }

        $file->storeAs('public', $name);

        return $name;
    }

    private function createImagenVerificacion($idCliente, $ruta,$tipo,$imagen){
        
        if($imagen == null)
            ImagenVerificacion::create([
                'id_cliente' => $idCliente,
                'nombre' => $ruta,
                'tipo' => $tipo,
            ]);
        else{
            
            $imagen->nombre = $ruta;
            $imagen->estado = 0;
            $imagen->save();
        }
    }

}
