<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\MailAssistant;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showViewResetPassword($token){
        //Buscar usuario por token
        //cambiar Token
        //enviar token a la view para el formulario
        return view('verify');

    }
    public function sendResetPasswordEmail(Request $req){

        $req->validate([

            'email' => 'email'

        ]);

        $user = User::where('email',$req->email)->first();

        $link = route('restore_password_view',$user->remember_token);

        $mail = new MailAssistant([
            'subject' => 'Recover you HaiPay password',
            'destination' => $req->email,
            'view' => 'emails.reset_password_email',
            'data' => [

                'link' => $link

            ],
        ]);

        $mail->send();

        return view('verify_email_change_password');

    }
    public function showViewRestorePassword($token){

        $user = User::where('remember_token',$token)->first();

        if($user != null){

            $user->save();
            return view('verify',[
                'token' => $token
            ]);
        }else{

            return redirect()->route('send_recover_email')->with([
                'messages'=>[
                    'The link is not valid'
                ]
            ]);

        }



    }
    public function restorePassword(Request $req){


        $user = User::where('remember_token',$req->token)->first();

        if($user != null){

            $req->validate([
                'password' => ['max:255','confirmed']
            ]);
            
            $user->updateRememberToken();

            $user->password = Hash::make($req->password);

            $user->save();

            return redirect()->route('login');

        }else{

            return redirect()->route('send_recover_email')->with([
                'messages'=>[
                    'The link is not valid'
                ]
            ]);

        }

    }

}
