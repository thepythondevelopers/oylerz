<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Illuminate\Support\Facades\Auth;

class Vendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
     
          if (Auth::user() && Auth::user()->role=='vendor' && Auth::user()->status==1) {
                 return $next($request);
          }
          else {
               return redirect('/');
          }
     }


}
