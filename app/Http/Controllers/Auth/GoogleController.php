<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Usuario;

class GoogleController
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = Usuario::where('usuario_correo', $googleUser->getEmail())->first();

            if (!$user) {
                return redirect('/login')->withErrors('Error al iniciar sesión: Usuario no encontrado');
            }

            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Error al iniciar sesión: ' . $e->getMessage());
        }
    }
}
