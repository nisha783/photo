<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                // Check if the current route is the admin dashboard, avoid redirecting if already there
                if ($request->route()->getName() !== 'admin.dashboard') {
                    return redirect()->route('admin.dashboard');
                }
            } else {
                // Non-admin users should be redirected to their dashboard only if not already there
                if ($request->route()->getName() !== 'user.dashboard') {
                    return redirect()->route('user.dashboard');
                }
            }
        } else {
            // If the user is not authenticated, redirect to the login page
            return redirect()->route('login');
        }

        return $next($request);
    }
}
