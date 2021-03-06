<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkSuperAdmin
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
        if(Auth::user()->level === 1){
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
