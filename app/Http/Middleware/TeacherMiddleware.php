<?php

namespace App\Http\Middleware;

use App\Models\TeacherModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('teacher')->check()) {
            if (Auth::guard('teacher')->user()->is_admin == 5) {
                return $next($request);
            } else {
                Auth::guard('teacher')->logout();
                return redirect('/login');
            }
        }
        
        return redirect('/login')->with('error', 'Please login to access the page.');
        
    }
}
