<?php

namespace App\Http\Middleware;


use Closure;
use App;
use Auth;

class AdminMiddleware
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
        if (Auth::user() && Auth::user()->role_id != 1)
    {
    return new Response(view('outofbound')->with('role', 'ADMIN'));
    }
        return $next($request);
    }
}
