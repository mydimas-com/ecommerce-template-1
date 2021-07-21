<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckStatusWebsite
{
    public function handle(Request $request, Closure $next)
    {
        $response = Http::withHeaders([
            'WEB_ID' => env('DIMAS_ID')
        ])->get('http://127.0.0.1:8080/api/statusweb/35');

        $web = $response->json();

        if($web == 1){
            return $next($request);            
        }

        // abort(403, 'Web sedang dinonaktifkan');
        return response()->view('vendor.inactive.index');
        // return $next($request);
    }
}
