<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\PeriodoAcademico;
use App\Models\Grupo;
use App\Models\Materia;

class AcademicStructureController
{
    public function storePeriod(Request $request)
    {
        try {

            $request->validate(
                [
                    'periodo_academico_año' => 'required|numeric',
                    'periodo_academico_inicio' => 'required|date',
                    'periodo_academico_fin' => 'required|date',
                    'institucion_id' => 'required|exists:instituciones,institucion_id',
                ],
                [
                    'periodo_academico_año.required' => 'El año es requerido',
                    'periodo_academico_año.numeric' => 'El año debe ser numérico',
                    'periodo_academico_inicio.required' => 'La fecha de inicio es requerida',
                    'periodo_academico_inicio.date' => 'La fecha de inicio debe ser una fecha válida',
                    'periodo_academico_fin.required' => 'La fecha de fin es requerida',
                    'periodo_academico_fin.date' => 'La fecha de fin debe ser una fecha válida',
                    'institucion_id.required' => 'La institución es requerida',
                    'institucion_id.exists' => 'La institución no existe',
                ]
            );

            $period = PeriodoAcademico::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Periodo creado con éxito',
                'data' => $period,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el periodo: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updatePeriod(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'periodo_academico_año' => 'required|numeric',
                    'periodo_academico_inicio' => 'required|date',
                    'periodo_academico_fin' => 'required|date',
                ],
                [
                    'periodo_academico_año.required' => 'El año es requerido',
                    'periodo_academico_año.numeric' => 'El año debe ser numérico',
                    'periodo_academico_inicio.required' => 'La fecha de inicio es requerida',
                    'periodo_academico_inicio.date' => 'La fecha de inicio debe ser una fecha válida',
                    'periodo_academico_fin.required' => 'La fecha de fin es requerida',
                    'periodo_academico_fin.date' => 'La fecha de fin debe ser una fecha válida',
                ]
            );

            $period = PeriodoAcademico::find($id);

            if (!$period) {
                return response()->json([
                    'success' => false,
                    'message' => 'Periodo no encontrado',
                ], 404);
            }

            $period->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Periodo actualizado con éxito',
                'data' => $period,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el periodo: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyPeriod($id)
    {
        try {
            $period = PeriodoAcademico::find($id);
            if (!$period) {
                return response()->json([
                    'success' => false,
                    'message' => 'Periodo no encontrado',
                ], 404);
            }
            $period->delete();
            return response()->json([
                'success' => true,
                'message' => 'Periodo eliminado con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el periodo: ' . $e->getMessage(),
            ]);
        }
    }

    public function storeGroup(Request $request)
    {
        try {
            $request->validate(
                [
                    'grupo_nombre' => 'required|string',
                    'grupo_año' => 'required|numeric',
                    'grupo_cupo' => 'required|numeric',
                    'grado_id' => 'required|exists:grados,grado_id',
                    'institucion_id' => 'required|exists:instituciones,institucion_id'
                ],
                [
                    'grupo_nombre.required' => 'El nombre es requerido',
                    'grupo_nombre.string' => 'El nombre debe ser una cadena de caracteres',
                    'grupo_año.required' => 'El año es requerido',
                    'grupo_año.numeric' => 'El año debe ser numérico',
                    'grupo_cupo.required' => 'El cupo es requerido',
                    'grupo_cupo.numeric' => 'El cupo debe ser numérico',
                    'grado_id.required' => 'El grado es requerido',
                    'grado_id.exists' => 'El grado no existe',
                    'institucion_id.required' => 'La institución es requerida',
                    'institucion_id.exists' => 'La institución no existe',
                ]
            );

            $group = Grupo::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Grupo creado con éxito',
                'data' => $group,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el grupo: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateGroup(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'grupo_nombre' => 'required|string',
                    'grupo_año' => 'required|numeric',
                    'grupo_cupo' => 'required|numeric',
                ],
                [
                    'grupo_nombre.required' => 'El nombre es requerido',
                    'grupo_nombre.string' => 'El nombre debe ser una cadena de caracteres',
                    'grupo_año.required' => 'El año es requerido',
                    'grupo_año.numeric' => 'El año debe ser numérico',
                    'grupo_cupo.required' => 'El cupo es requerido',
                    'grupo_cupo.numeric' => 'El cupo debe ser numérico',
                ]
            );

            $group = Grupo::find($id);

            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Grupo no encontrado',
                ], 404);
            }

            $group->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Grupo actualizado con éxito',
                'data' => $group,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el grupo: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyGroup($id)
    {
        try {
            $group = Grupo::find($id);

            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Grupo no encontrado',
                ], 404);
            }

            $group->delete();

            return response()->json([
                'success' => true,
                'message' => 'Grupo eliminado con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el grupo: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function storeSubject(Request $request)
    {
        try {
            $request->validate(
                [
                    'materia_nombre' => 'required|string',
                    'institucion_id' => 'required|exists:instituciones,institucion_id',
                ]
            );

            $subject = Materia::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Materia creada con éxito',
                'data' => $subject,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la materia: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateSubject(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'materia_nombre' => 'required|string',
                ]
            );

            $subject = Materia::find($id);

            if (!$subject) {
                return response()->json([
                    'success' => false,
                    'message' => 'Materia no encontrada',
                ], 404);
            }

            $subject->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Materia actualizada con éxito',
                'data' => $subject,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la materia: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroySubject($id)
    {
        try {
            $subject = Materia::find($id);

            if (!$subject) {
                return response()->json([
                    'success' => false,
                    'message' => 'Materia no encontrada',
                ], 404);
            }

            $subject->delete();

            return response()->json([
                'success' => true,
                'message' => 'Materia eliminada con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la materia: ' . $e->getMessage(),
            ], 500);
        }
    }
}
