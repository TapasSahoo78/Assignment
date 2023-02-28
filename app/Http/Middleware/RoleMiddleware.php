<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $role = strtolower($request->user()->hasRole($role));
        $allowed_roles = array_slice(func_get_args(), 2);
        if (!auth()->user()->hasRole(in_array($role, $allowed_roles))) {
            abort(401);
        }

        return $next($request);
    }
}
