<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticatedCustom
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('role')) {
            $role = $request->session()->get('role');
            return redirect()->route($role . '.dashboard');
        }
        return $next($request);
    }
}