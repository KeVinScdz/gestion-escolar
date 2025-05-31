<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\Administrativo;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Tutor;
use App\Models\Usuario;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'usuario_nombre' => 'required|string|max:255',
                'usuario_apellido' => 'required|string|max:255',
                'usuario_correo' => 'required|string|email|max:255|unique:usuarios,usuario_correo',
                'usuario_documento_tipo' => 'required|string|in:CC,TI,CE',
                'usuario_documento' => 'required|string|max:255|unique:usuarios,usuario_documento',
                'usuario_nacimiento' => 'required|date',
                'usuario_direccion' => 'required|string|max:255',
                'usuario_telefono' => 'required|numeric|digits_between:7,12',
                'usuario_contra' => 'required|string|min:8',
                'rol_id' => 'required|exists:roles,rol_id',
            ], [
                'usuario_nombre.required' => 'El nombre es obligatorio.',
                'usuario_apellido.required' => 'El apellido es obligatorio.',
                'usuario_correo.required' => 'El correo electrónico es obligatorio.',
                'usuario_correo.email' => 'El formato del correo no es válido.',
                'usuario_correo.unique' => 'El correo electrónico ya está en uso.',
                'usuario_documento_tipo.required' => 'El tipo de documento es obligatorio.',
                'usuario_documento_tipo.in' => 'El tipo de documento no es válido.',
                'usuario_documento.required' => 'El número de documento es obligatorio.',
                'usuario_documento.unique' => 'El número de documento ya está en uso.',
                'usuario_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
                'usuario_nacimiento.date' => 'El formato de la fecha de nacimiento no es válido.',
                'usuario_direccion.required' => 'La dirección es obligatoria.',
                'usuario_telefono.required' => 'El teléfono es obligatorio.',
                'usuario_telefono.numeric' => 'El teléfono debe ser numérico.',
                'usuario_telefono.digits_between' => 'El teléfono debe tener entre 7 y 12 dígitos.',
                'usuario_contra.required' => 'La contraseña es obligatoria.',
                'usuario_contra.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'rol_id.required' => 'El rol es obligatorio.',
                'rol_id.exists' => 'El rol seleccionado no existe.',
            ]);

            $user = $request->all();


            $usuario = Usuario::create($user);

            if ($usuario->rol_id == 2) {
                $administrativo = Administrativo::create([
                    'usuario_id' => $usuario->usuario_id,
                    'institucion_id' => $request->input('institucion_id'),
                    'administrativo_cargo' => $request->input('administrativo_cargo'),
                ]);

                if (!$request->has('permisos') || empty($request->input('permisos'))) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'El administrador debe tener al menos un permiso',
                    ], 400);
                }

                $permisos = $request->input('permisos', []);
                $administrativo->permisos()->sync($permisos);
            }

            if ($usuario->rol_id == 3) {
                Docente::create([
                    'usuario_id' => $usuario->usuario_id,
                    'institucion_id' => $request->input('institucion_id'),
                    'docente_titulo' => $request->input('docente_titulo'),
                ]);
            }

            if ($usuario->rol_id == 4) {
                Estudiante::create([
                    'usuario_id' => $usuario->usuario_id,
                    'institucion_id' => $request->input('institucion_id'),
                ]);
            }

            if ($usuario->rol_id == 5) {
                Tutor::create([
                    'usuario_id' => $usuario->usuario_id,
                    'estudiante_id' => $request->input('estudiante_id'),
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente',
                'data' => $usuario,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $usuario = Usuario::findOrFail($id);

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            if ($request->has('usuario_contra') && $request->input('usuario_contra') === "" || $request->input('usuario_contra') === null) {
                $request->request->remove('usuario_contra');
            }

            // Validation for password update
            if ($request->has('usuario_contra') && $request->has('actual_contra') && $request->input('usuario_contra') !== "" && $request->input('usuario_contra') !== null) {
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

            if ($usuario->rol_id == 2) {
                $administrativo = Administrativo::where('usuario_id', $usuario->usuario_id)->first();

                if (!$administrativo) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Administrativo no encontrado',
                    ]);
                }

                if ($request->has('administrativo_cargo')) {
                    $administrativo->update([
                        'administrativo_cargo' => $request->input('administrativo_cargo'),
                    ]);
                }

                $permisos = $request->input('permisos', []);
                $administrativo->permisos()->sync($permisos);
            }

            if ($usuario->rol_id == 3) {
                $docente = Docente::where('usuario_id', $usuario->usuario_id)->first();

                if (!$docente) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Docente no encontrado',
                    ]);
                }

                if ($request->has('docente_titulo')) {
                    $docente->update([
                        'docente_titulo' => $request->input('docente_titulo'),
                    ]);
                }
            }
            $usuario->update($request->all());

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado correctamente',
                'data' => $usuario,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
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
            DB::beginTransaction();

            $usuario = Usuario::findOrFail($id);

            if (!$usuario) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            if ($usuario->rol_id == 2) {
                $administrativo = Administrativo::where('usuario_id', $usuario->usuario_id)->first();
                if ($administrativo) {
                    $administrativo->delete();
                } else {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Administrativo no encontrado',
                    ], 404);
                }
            }

            if ($usuario->rol_id == 3) {
                $docente = Docente::where('usuario_id', $usuario->usuario_id)->first();
                if ($docente) {
                    $docente->delete();
                } else {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Docente no encontrado',
                    ], 404);
                }
            }

            if ($usuario->rol_id == 4) {
                $estudiante = Estudiante::where('usuario_id', $usuario->usuario_id)->first();
                if ($estudiante) {
                    $estudiante->delete();
                } else {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Estudiante no encontrado',
                    ], 404);
                }
            }

            if ($usuario->rol_id == 5) {
                $tutor = Tutor::where('usuario_id', $usuario->usuario_id)->first();
                if ($tutor) {
                    $tutor->delete();
                } else {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Tutor no encontrado',
                    ], 404);
                }
            }

            $usuario->delete();

            DB::commit();
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
