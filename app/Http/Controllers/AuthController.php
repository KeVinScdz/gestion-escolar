<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'usuario_correo' => 'required|email',
                'usuario_contraseña' => 'required|min:8',
            ], [
                'usuario_correo.required' => 'El correo es obligatorio.',
                'usuario_correo.email' => 'El correo debe ser un correo electrónico válido.',
                'usuario_contraseña.required' => 'La contraseña es obligatoria.',
                'usuario_contraseña.min' => 'La contraseña debe tener al menos 8 caracteres.'
            ]);

            $email = $request->input('usuario_correo');
            $password = $request->input('usuario_contraseña');

            $user = Usuario::where('usuario_correo', $email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el usuario',
                ], 401);
            }

            if (!password_verify($password, $user->usuario_contraseña)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contraseña incorrecta',
                ], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al iniciar sesión: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Cierre de sesión exitoso',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar sesión: ' . $e->getMessage(),
            ], 500);
        }
    }
}
