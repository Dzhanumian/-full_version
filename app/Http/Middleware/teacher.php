<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class teacher
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
            if(Auth::user()->role == 'admin' || 'owner' || 'teacher')     
            {
                return $next($request);
            }
            abort(404);
        }
        return redirect('/login');
    }
}
