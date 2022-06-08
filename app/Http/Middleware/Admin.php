<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Illuminate\Support\Facades\Auth;

class Admin 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
     
          if (Auth::user() && Auth::user()->role=='admin') {
                 if(Route::currentRouteName()=='admin.index'){
                    return redirect()->route('admin.dashboard');
                 }
                 return $next($request);
          }
          else {
               if(Route::currentRouteName()=='admin.index'){
                    return $next($request);
                 }
               return redirect('/');
          }
     }


}
