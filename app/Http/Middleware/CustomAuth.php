<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       $user_name =  session()->get('user_name');
       $user_role =  session()->get('user_role');
            if( !isset($user_name) || empty($user_name) )
            {
               return redirect('login') ;
            }
        return $next($request);
    } 
}
