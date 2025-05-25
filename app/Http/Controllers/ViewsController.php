<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
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

    public function institutions()
    {
        $usuario = Auth::user()->load('rol');
        $instituciones = Institucion::paginate(2);

        return view('app.admin.institutions', compact('usuario', 'instituciones'));
    }
}
