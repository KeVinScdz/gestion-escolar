<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuarios = Usuario::all();

            return response()->json([
                'success' => true,
                'message' => 'Usuarios encontrados',
                'data' => $usuarios,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los usuarios',
            ], 500);
        }
    }

    /**
     * Display a listing of the resource paginated.
     */
    public function paginate(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $perPage = $request->input('per_page', 10);

            $usuarios = Usuario::paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'success' => true,
                'message' => 'Usuarios encontrados',
                'data' => $usuarios,
                'limit' => $usuarios->perPage(),
                'total' => $usuarios->total(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los usuarios: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = $request->all();

            $usuario = Usuario::create($user);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente',
                'data' => $usuario,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Usuario encontrado',
                'data' => $usuario,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el usuario: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            
            $usuario = Usuario::findOrFail($id);

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            // Validation for password update
            if ($request->has('usuario_contra')) {
                $request->validate([
                    'usuario_contra' => 'required|string|min:8',
                    'usuario_contra_confirmacion' => 'required|string|same:usuario_contra',
                    'actual_contra' => 'required|string',
                ], [
                    'usuario_contra.required' => 'La nueva contraseña es obligatoria',
                    'usuario_contra.string' => 'La nueva contraseña debe ser una cadena de texto',
                    'usuario_contra.min' => 'La nueva contraseña debe tener al menos 8 caracteres',
                    'usuario_contra_confirmacion.required' => 'La confirmación de la nueva contraseña es obligatoria',
                    'usuario_contra_confirmacion.string' => 'La confirmación de la nueva contraseña debe ser una cadena de texto',
                    'usuario_contra_confirmacion.same' => 'La confirmación de la nueva contraseña no coincide',
                    'actual_contra.required' => 'La contraseña actual es obligatoria',
                    'actual_contra.string' => 'La contraseña actual debe ser una cadena de texto',
                ]);

                // Check if the current password is correct
                if (!Hash::check($request->input('actual_contra'), $usuario->usuario_contra)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'La contraseña actual es incorrecta',
                    ], 401);
                }
            }

            $usuario->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado correctamente',
                'data' => $usuario,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el usuario: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            $usuario->delete();

            return response()->json([
                'success' => true,
                'message' => 'Usuario eliminado correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el usuario: ' . $e->getMessage(),
            ], 500);
        }
    }
}
