<?php

namespace App\Http\Controllers\Web;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'usuario_correo' => 'required|email',
                'usuario_contra' => 'required',
            ], [
                'usuario_correo.required' => 'El correo es requerido',
                'usuario_correo.email' => 'El correo debe ser válido',
                'usuario_contra.required' => 'La contraseña es requerida',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $credentials = $request->all();

            $user = Usuario::with(['rol'])->where('usuario_correo', $credentials['usuario_correo'])->first();

            if (!$user) {
                return redirect()->back()->with('error', 'Usuario no encontrado')->withInput();
            }
            
            if (!Hash::check($credentials['usuario_contra'], $user->usuario_contra)) {
                return redirect()->back()->with('error', 'Contraseña incorrecta')->withInput();
            }
            
            Auth::login($user);
            
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al iniciar sesión: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
