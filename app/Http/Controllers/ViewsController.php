<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

use App\Models\Estudiante;
use App\Models\Grado;
use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\PeriodoAcademico;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Usuario;

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
        $usuarioSesion = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos');
        $usuario = $usuarioSesion;

        return view('app.dashboard', compact('usuarioSesion', 'usuario'));
    }

    // Admin Views
    public function institutions()
    {
        $usuarioSesion = Auth::user()->load('rol');
        $search = request('search');

        $instituciones = Institucion::search($search ?? '')->paginate(5);

        return view('app.admin.institutions', compact('usuarioSesion', 'instituciones'));
    }

    public function users()
    {
        $usuarioSesion = Auth::user()->load('rol');
        $search = request('search');

        $usuarios = Usuario::with('administrativo', 'administrativo.permisos', 'administrativo.institucion', 'estudiante', 'estudiante.institucion', 'docente', 'docente.institucion', 'tutor')->search($search ?? '')->paginate(5);
        $roles = Rol::all();
        $instituciones = Institucion::all();
        $estudiantes = Estudiante::with('usuario', 'tutor')->get();
        $permisos = Permiso::all();

        return view('app.admin.users', compact('usuarioSesion', 'usuarios', 'roles', 'instituciones', 'estudiantes', 'permisos'));
    }

    public function institution()
    {
        $usuarioSesion = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos');

        $institucion = Institucion::where('institucion_id', $usuarioSesion->administrativo->institucion_id)->first();

        return view('app.administrative.institution', compact('usuarioSesion', 'institucion'));
    }

    public function administratives()
    {
        $usuarioSesion = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos');
        $search = request('search');

        $administrativos = Usuario::with('administrativo', 'administrativo.permisos', 'administrativo.institucion', 'rol')
            ->search($search ?? '')
            ->where('rol_id', 2)->whereNot('usuario_id', '=', $usuarioSesion->usuario_id)
            ->whereHas('administrativo', function ($query) use ($usuarioSesion) {
                $query->where('institucion_id', $usuarioSesion->administrativo->institucion_id);
            })
            ->paginate(10);

        $permisos = Permiso::all();
        $institucion = Institucion::where('institucion_id', $usuarioSesion->administrativo->institucion_id)->first();

        return view('app.administrative.administratives', compact('usuarioSesion', 'administrativos', 'permisos', 'institucion'));
    }

    public function teachers()
    {
        $usuarioSesion = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos');
        $search = request('search');

        $docentes = Usuario::with('docente', 'rol')
            ->search($search ?? '')
            ->where('rol_id', 3)
            ->whereHas('docente', function ($query) use ($usuarioSesion) {
                $query->where('institucion_id', $usuarioSesion->administrativo->institucion_id);
            })
            ->paginate(10);

        $institucion = Institucion::where('institucion_id', $usuarioSesion->administrativo->institucion_id)->first();


        return view('app.administrative.teachers', compact('usuarioSesion', 'docentes', 'institucion'));
    }

    public function students()
    {
        $usuarioSesion = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos', 'administrativo.institucion');
        $search = request('search');

        $estudiantes = Usuario::with('estudiante', 'estudiante.tutor', 'estudiante.matriculas', 'rol')
            ->where('rol_id', 4)
            ->whereHas('estudiante', function ($query) use ($usuarioSesion) {
                $query->where('institucion_id', $usuarioSesion->administrativo->institucion_id);
            })
            ->search($search ?? '')->paginate(10);

        return view('app.administrative.students', compact('usuarioSesion', 'estudiantes'));
    }

    public function periods()
    {
        $usuarioSesion = Auth::user()->load('rol', 'administrativo', 'administrativo.permisos');
        $institucion_id = $usuarioSesion->administrativo->institucion_id;

        $availableYears = PeriodoAcademico::where('institucion_id', $institucion_id)
            ->select('periodo_academico_año as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $selectedYear = request('year_filter');

        $query = PeriodoAcademico::where('institucion_id', $institucion_id);

        if ($selectedYear) {
            $query->where('periodo_academico_año', $selectedYear);
        }

        $periodos = $query->orderBy('periodo_academico_año', 'desc')
            ->orderBy('periodo_academico_inicio', 'asc')
            ->get();

        return view('app.administrative.periods', compact('usuarioSesion', 'periodos', 'availableYears', 'selectedYear'));
    }
}
