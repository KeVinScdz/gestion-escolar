<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
