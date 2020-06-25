<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Persona;
use App\Cliente;
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
    protected function registerClient(Request $data){

        $this->validate($data,[
            'id' => ['nullable', 'unique:personas,cedula', 'max:20','min:0'],
            'phone' => ['nullable', 'unique:users,telefono', 'max:20','min:0'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $persona = Persona::create([
            'nombre'=>$data['name'],
            'cedula'=>$data['cedula'],
        ]);
        $user = User::create([

            'id_persona' => $persona->id,
            'email' => $data['email'],
            'tipo' => 1,
            'estado' => 1,
            'password' => Hash::make($data['password']),
        ]);

        Cliente::create([
            'id_usuario' => $user->id,
        ]);

        return redirect()->route('login');
        
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
