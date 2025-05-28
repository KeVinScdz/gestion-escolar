<?php

namespace App\Http\Controllers\Api;

use App\Models\PeriodoAcademico;
use Illuminate\Http\Request;

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
}
