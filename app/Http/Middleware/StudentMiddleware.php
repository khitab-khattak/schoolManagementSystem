<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('student')->check()) {
            if (Auth::guard('student')->user()->is_admin == 6) {
                return $next($request);
            } else {
                Auth::guard('student')->logout();
                return redirect('/login');
            }
        }
        
        return redirect('/login')->with('error', 'Please login to access the page.');
    }
}
