<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminAndOwner
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
        if (Auth::check() == true) {
            if(Auth::user()->role == 'admin')     
            {
                return $next($request);
            }
            if(Auth::user()->role == 'owner')     
            {
                return $next($request);
            }
            abort(404);
        }
        return redirect('/login');
    }
    
}
