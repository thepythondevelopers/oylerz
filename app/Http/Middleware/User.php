<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
     
          if (Auth::user() && Auth::user()->role=='user') {
                 return $next($request);
          }
          else {
               return redirect('/');
          }
     }


}
