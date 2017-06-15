<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Admin {

    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->hasRole('client') )
        {
            return redirect('/home/question');
        }       
        return $next($request);
    }
}