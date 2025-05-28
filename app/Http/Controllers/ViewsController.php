<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Institucion;
use App\Models\Permiso;
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
        $usuario = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos');

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
        $usuario = Auth::user()->load('rol');
        $search = request('search');

        $usuarios = Usuario::with('administrativo', 'administrativo.permisos', 'estudiante', 'docente', 'tutor')->search($search ?? '')->paginate(5);
        $roles = Rol::all();
        $instituciones = Institucion::all();
        $estudiantes = Estudiante::with('usuario', 'tutor')->get();
        $permisos = Permiso::all();

        return view('app.admin.users', compact('usuario', 'usuarios', 'roles', 'instituciones', 'estudiantes', 'permisos'));
    }

    public function administratives()
    {
        $usuario = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos');
        $search = request('search');

        $administrativos = Usuario::with('administrativo', 'administrativo.permisos', 'administrativo.institucion', 'rol')->search($search ?? '')->where('rol_id', 2)->whereNot('usuario_id', '=', $usuario->usuario_id)->paginate(10);
        $permisos = Permiso::all();
        $institucion = Institucion::where('institucion_id', $usuario->administrativo->institucion_id)->first();

        return view('app.administrative.administratives', compact('usuario', 'administrativos', 'permisos', 'institucion'));
    }

    public function students()
    {
        $usuario = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos', 'administrativo.institucion');
        $search = request('search');

        $estudiantes = Usuario::with('estudiante', 'estudiante.tutor', 'estudiante.matriculas', 'rol')
            ->where('rol_id', 4)
            ->whereHas('estudiante', function ($query) use ($usuario) {
                $query->where('institucion_id', $usuario->administrativo->institucion_id);
            })
            ->search($search ?? '')->paginate(10);

        return view('app.administrative.students', compact('usuario', 'estudiantes'));
    }
}
