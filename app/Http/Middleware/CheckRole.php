<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();


        if ($user->role == 'admin') {
            return $next($request);
        }

        if ($user->role == 'client' && $request->routeIs('profile.*')) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Bạn không đủ quyền truy cập trang này');

        // $user->role == 'admin' ?  $next($request) :  redirect()->route('home')->with('error', 'Bạn không đủ quyền truy cập');
    }
}
