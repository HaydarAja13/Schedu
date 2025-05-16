<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!$request->session()->has('role') || $request->session()->get('role') !== $role) {
            return redirect('/');
        }
        return $next($request);
    }
}
