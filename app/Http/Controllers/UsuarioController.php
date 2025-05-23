<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function getAll()
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

    public function paginate(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);

            $usuarios = Usuario::with(['persona', 'rol'])->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Usuarios encontrados',
                'data' => $usuarios->items(),
                'total' => $usuarios->total(),
                'limit' => $usuarios->perPage(),
                'page' => $usuarios->currentPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los usuarios: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getByPK($id)
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
                'message' => 'Error al obtener el usuario',
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            ['user' => $user] = $request->all();

            $usuario = Usuario::create($user);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente',
                'data' => $usuario,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado',
                ], 404);
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
                'message' => 'Error al actualizar el usuario',
            ], 500);
        }
    }

    public function destroy($id)
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
                'message' => 'Error al eliminar el usuario',
            ], 500);
        }
    }
}
