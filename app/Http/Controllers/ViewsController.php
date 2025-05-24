<?php

namespace App\Http\Controllers;

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
        $user = Auth::user()->load('rol');

        return view('app.dashboard', ['usuario' => $user]);
    }
}
