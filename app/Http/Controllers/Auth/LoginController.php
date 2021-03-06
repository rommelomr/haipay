<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(){

        $this->middleware('guest')->except('logout');
        
    }

    public function showViewAccountDontVerified(){

        return view('auth.dont_verified');

    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            if($user->estado == 1){


                if($user->tipo == 1){
                    
                    if($user->verificado == 1){
                    
                        $this->redirectTo = '/dashboard_clients';
    
                    }else{

                        Auth::logout();
                        return redirect()->route('account_dont_verified');

                    }

                }else if($user->tipo == 2){
                    $this->redirectTo = '/clients';
    
                }else{
                    $this->redirectTo = '/users';

                }
                        
    
                return $this->sendLoginResponse($request);
            }else{
                Auth::logout();
                return redirect()->back();
            }
            
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }    
}
