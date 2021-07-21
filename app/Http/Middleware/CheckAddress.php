<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAddress
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->status_address == 1){
            return $next($request);            
        }
        return redirect()->route('profile');
    }
}
