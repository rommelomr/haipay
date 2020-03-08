<?php

namespace App\Http\Middleware;

use Closure;

class CheckTipo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$tipos)
    {
        $user = $request->user();

        if(!$user){

            return redirect('/login');
        }else{

            if(!in_array($user->tipo,$tipos)){

                return redirect('/home');
            }
        }

        return $next($request);

    }
}
