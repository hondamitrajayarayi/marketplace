<?php

namespace App\Http\Middleware;

use Closure;
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
    public function handle($request, Closure $next)
    {
        
        // dd(Auth::user());
        if (!Auth::check()) {
            return redirect()->route('loginnew');
        }
        //role 1 == admin
        if (Auth::user()->role == 1) {
            return $next($request); 
        }
        // role 2 == crm
        if (Auth::user()->role == 2 ) {
            return redirect()->route('crm');
        }
        // role 3 == admin and crm
        if (Auth::user()->role == 3) {
            return redirect()->route('adminandcrm');
        }
    }
}
