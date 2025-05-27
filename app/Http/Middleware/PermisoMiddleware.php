<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermisoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permiso): Response
    {
        $user = Auth::user()->load('administrativo', 'administrativo.permisos');

        if (!$user->administrativo->permisos->contains('permiso_id', $permiso)) {
            return response()->redirectTo('/dashboard');
        }

        return $next($request);
    }
}
