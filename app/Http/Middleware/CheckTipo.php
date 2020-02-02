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

        if(!in_array($request->user()->tipo,$tipos)){

            return redirect('/home');
        }

        return $next($request);

    }
}
