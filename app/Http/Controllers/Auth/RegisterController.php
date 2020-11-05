<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Persona;
use App\Cliente;
use App\Referido;

use App\MailAssistant;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function makeRegister($data,$persona){

        $token = User::generateRememberToken();

        $user = User::create([

            'id_persona' => $persona->id,
            'email' => $data['email'],
            'telefono' => $data['phone'],
            'tipo' => 1,
            'estado' => 1,
            'remember_token' => $token,
            'password' => Hash::make($data['password'])

        ]);

        $cliente = Cliente::create([
            'id_usuario' => $user->id,
        ]);

        //Si el registro es gracias a un referido:
        if($data->referred != null){

            //Se crea el referido
            Referido::create([
                'id_cliente' => $data->referred,
                'id_referido' => $cliente->id
            ]);
            
        }

        $mail = new MailAssistant;

        $mail->sendValidationLink([
            'name' => $persona->nombre,
            'email' => $user->email,
            'token' => $token
        ]);

        return redirect()->route('account_dont_verified');

    }
    protected function registerClient(Request $data){

        $this->validate($data,[
            'id' => ['required', 'max:20', 'min:0'],
            'phone' => ['nullable', 'unique:users,telefono', 'max:20','min:0'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referred' => ['nullable', 'exists:users,id'],
        ]);

        //Consulto a la persona por cédula
        $persona = Persona::where('cedula',$data->id)
        ->with([
            'noUsuario',
            'usuario'=>function($query){
                $query->with('cliente');
            },
        ])->first();

        //Si la persona no existe se hace registro normal
        if($persona == null){

            $persona = Persona::create([
                'nombre'=>$data['name'],
                'cedula'=>$data['id'],
            ]);

            return $this->makeRegister($data,$persona);
        }else{

            $person_is_client = isset($persona->usuario->cliente) && $persona->usuario->cliente != null;

            $person_is_only_no_user = $persona->usuario == null && $persona->noUsuario != null;

            if($person_is_client){

                return redirect()->route('register')->with(['messages'=>[
                    'The ID has already been taken.'
                ]]);

            }else if($person_is_only_no_user){

                $right_register_code = $data->register_code == $persona->noUsuario->codigo_registro;
                
                if($right_register_code){
                    $persona->es_usuario = 1;
                    $persona->save();
                    return $this->makeRegister($data,$persona);

                    
                }else{
                    return redirect()->route('register')->with(['messages'=>[
                        'Register code is not valid.'
                    ]]);    
                }

            }else{
                return redirect()->route('register')->with(['messages'=>[
                    'There was a problen with the register. Please, try again.'
                ]]);
            }
        }

        //Si la persona existe

            //si la persona tiene cliente, se devuelve un error: ya existe una persona registrada con esta cédula

            //Si la person NO tiene cliente (y está en no usuarios): Reenviar a la interfaz donde se ingresa el código de verificacion

/*
        $persona = Persona::firstOrcreate([
            'nombre'=>$data['name'],
            'cedula'=>$data['id'],
        ]);

        $user = User::create([

            'id_persona' => $persona->id,
            'email' => $data['email'],
            'telefono' => $data['phone'],
            'tipo' => 1,
            'estado' => 1,
            'password' => Hash::make($data['password']),
        ]);

        $cliente = Cliente::create([
            'id_usuario' => $user->id,
        ]);

        //Si el registro es gracias a un referido:
        if($data->referred != null){

            //Se crea el referido
            Referido::create([
                'id_cliente' => $data->referred,
                'id_referido' => $cliente->id
            ]);
            
        }

        return redirect()->route('login');
*/
        
    }
    private function validateClient($data){
    }
    protected function validator(array $data)
    {
        return $this->validateClient($data);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    private function createClient($data){
    }
    protected function create(array $data)
    {
        return $this->createClient($data);
    }
}
