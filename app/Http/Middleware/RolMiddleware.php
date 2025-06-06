<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $usuarioSesion = Auth::user();
        
        // Convert roles to integers if they are strings
        $roles = array_map(function($role) {
            return is_numeric($role) ? (int)$role : $role;
        }, $roles);

        if (!in_array($usuarioSesion->rol_id, $roles)) {
            return response()->redirectTo('/');
        }

        return $next($request);
    }
}
