<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ParentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('parent')->check()) {
            if (Auth::guard('parent')->user()->is_admin == 7) {
                return $next($request);
            } else {
                Auth::guard('parent')->logout();
                return redirect('/login');
            }
        }
        
        return redirect('/login')->with('error', 'Please login to access the page.');
    }
}
