<?php

namespace App\Http\Middleware;

use App\Exceptions\InsufficientRoleException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if(!$request->user()->can('role', $role)) {
            throw new InsufficientRoleException($request->user()->role, $role);
        }
        return $next($request);
    }
}
