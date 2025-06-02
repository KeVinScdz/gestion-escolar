<?php

namespace App\Http\Controllers\Api;

use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            request()->validate([
                'institucion_nombre' => 'required|string|max:255',
                'institucion_telefono' => 'required|numeric|digits_between:7,12',
                'institucion_correo' => 'required|email|unique:instituciones,institucion_correo',
                'institucion_direccion' => 'required|string|max:255',
                'institucion_nit' => 'required|string|unique:instituciones,institucion_nit',
                'nota_minima' => 'required|numeric',
                'nota_maxima' => 'required|numeric',
                'nota_aprobatoria' => 'required|numeric',
            ], [
                'institucion_nombre.required' => 'El nombre de la institución es obligatorio.',
                'institucion_nombre.string' => 'El nombre debe ser una cadena de texto.',
                'institucion_nombre.max' => 'El nombre no debe superar 255 caracteres.',
                'institucion_telefono.required' => 'El teléfono es obligatorio.',
                'institucion_telefono.numeric' => 'El teléfono debe ser numérico.',
                'institucion_telefono.digits_between' => 'El teléfono debe tener entre 7 y 10 dígitos.',
                'institucion_correo.required' => 'El correo es obligatorio.',
                'institucion_correo.email' => 'El correo debe ser un correo válido.',
                'institucion_correo.unique' => 'El correo ya está registrado.',
                'institucion_direccion.required' => 'La dirección es obligatoria.',
                'institucion_direccion.string' => 'La dirección debe ser una cadena de texto.',
                'institucion_direccion.max' => 'La dirección no debe superar 255 caracteres.',
                'institucion_nit.required' => 'El NIT es obligatorio.',
                'institucion_nit.string' => 'El NIT debe ser una cadena de texto.',
                'institucion_nit.unique' => 'El NIT ya está registrado.',
                'nota_minima.required' => 'La nota mínima es obligatoria.',
                'nota_minima.numeric' => 'La nota mínima debe ser un número.',
                'nota_maxima.required' => 'La nota máxima es obligatoria.',
                'nota_maxima.numeric' => 'La nota máxima debe ser un número.',
                'nota_aprobatoria.required' => 'La nota aprobatoria es obligatoria.',
                'nota_aprobatoria.numeric' => 'La nota aprobatoria debe ser un número.',
            ]);

            $institucion = Institucion::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Institución creada correctamente',
                'data' => $institucion,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $institucion = Institucion::find($id);

            if (!$institucion) {
                return response()->json([
                    'success' => false,
                    'message' => 'Institución no encontrada.',
                ], 404);
            }

            request()->validate([
                'institucion_nombre' => 'required|string|max:255',
                'institucion_telefono' => 'required|numeric|digits_between:7,12',
                'institucion_correo' => 'required|email|unique:instituciones,institucion_correo,' . $id . ',institucion_id',
                'institucion_direccion' => 'required|string|max:255',
                'institucion_nit' => 'required|string|unique:instituciones,institucion_nit,' . $id . ',institucion_id',
                'nota_minima' => 'required|numeric',
                'nota_maxima' => 'required|numeric',
                'nota_aprobatoria' => 'required|numeric',
            ], [
                'institucion_nombre.required' => 'El nombre de la institución es obligatorio.',
                'institucion_nombre.string' => 'El nombre debe ser una cadena de texto.',
                'institucion_nombre.max' => 'El nombre no debe superar 255 caracteres.',
                'institucion_telefono.required' => 'El teléfono es obligatorio.',
                'institucion_telefono.numeric' => 'El teléfono debe ser numérico.',
                'institucion_telefono.digits_between' => 'El teléfono debe tener entre 7 y 10 dígitos.',
                'institucion_correo.required' => 'El correo es obligatorio.',
                'institucion_correo.email' => 'El correo debe ser un correo válido.',
                'institucion_correo.unique' => 'El correo ya está registrado.',
                'institucion_direccion.required' => 'La dirección es obligatoria.',
                'institucion_direccion.string' => 'La dirección debe ser una cadena de texto.',
                'institucion_direccion.max' => 'La dirección no debe superar 255 caracteres.',
                'institucion_nit.required' => 'El NIT es obligatorio.',
                'institucion_nit.string' => 'El NIT debe ser una cadena de texto.',
                'institucion_nit.unique' => 'El NIT ya está registrado.',
                'nota_minima.required' => 'La nota mínima es obligatoria.',
                'nota_minima.numeric' => 'La nota mínima debe ser un número.',
                'nota_maxima.required' => 'La nota máxima es obligatoria.',
                'nota_maxima.numeric' => 'La nota máxima debe ser un número.',
                'nota_aprobatoria.required' => 'La nota aprobatoria es obligatoria.',
                'nota_aprobatoria.numeric' => 'La nota aprobatoria debe ser un número.',
            ]);

            $institucion->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Institución actualizada correctamente',
                'data' => $institucion,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la institución: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $institucion = Institucion::find($id);

            if (!$institucion) {
                return response()->json([
                    'success' => false,
                    'message' => 'Institución no encontrada.',
                ], 404);
            }

            $institucion->delete();

            return response()->json([
                'success' => true,
                'message' => 'Institución eliminada correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la institución: ' . $e->getMessage(),
            ], 500);
        }
    }
}
