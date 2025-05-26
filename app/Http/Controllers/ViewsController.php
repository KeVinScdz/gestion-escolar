<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Institucion;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewsController
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        $usuario = Auth::user()->load('rol');

        return view('app.dashboard', compact('usuario'));
    }

    // Admin Views
    public function institutions()
    {
        $usuario = Auth::user()->load('rol');
        $search = request('search');

        $instituciones = Institucion::search($search ?? '')->paginate(5);

        return view('app.admin.institutions', compact('usuario', 'instituciones'));
    }

    public function users()
    {
        $usuarioSesion = Auth::user()->load('rol');
        $search = request('search');
        $showAll = request('showAll') === 'true';

        $usuarios = Usuario::search($search ?? '')->paginate(5);
        $roles = Rol::all();
        $instituciones = Institucion::all();
        $estudiantes = Estudiante::with('usuario')->get();

        return view('app.admin.users', compact('usuarioSesion', 'usuarios', 'roles', 'instituciones', 'estudiantes'));
    }
}
