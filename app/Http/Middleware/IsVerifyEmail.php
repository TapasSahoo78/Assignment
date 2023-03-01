<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (auth()->user()->hasRole('user')) {
                if (!Auth::user()->is_email_verified) {
                    auth()->logout();
                    return redirect()->route('login')
                        ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
                }
            } else {
                return redirect('/admin/dashboard');
            }
        }

        return $next($request);
    }
}
