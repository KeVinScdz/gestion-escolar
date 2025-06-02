<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\PeriodoAcademico;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Asignacion;
use App\Models\Horario;
use App\Models\Bloque;
use App\Models\Docente;
use App\Models\Inasistencia;
use App\Models\Matricula;

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

    public function updateGroupAssignments(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $group = Grupo::find($id);

            if (!$group) {
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => 'Grupo no encontrado',
                ], 404);
            }

            $materias = $request->input('materias');
            $docentes = $request->input('docentes');

            $nuevasAsignaciones = [];

            foreach ($materias as $index => $materia_id) {
                $docente_id = $docentes[$index];

                $nuevasAsignaciones[] = [
                    'materia_id' => $materia_id,
                    'docente_id' => $docente_id,
                ];

                Asignacion::updateOrCreate(
                    [
                        'grupo_id' => $group->grupo_id,
                        'materia_id' => $materia_id,
                    ],
                    [
                        'docente_id' => $docente_id,
                    ]
                );
            }

            // Obtener asignaciones actuales
            $asignacionesActuales = Asignacion::where('grupo_id', $group->grupo_id)->get();

            foreach ($asignacionesActuales as $asignacion) {
                $existe = collect($nuevasAsignaciones)->contains(function ($nueva) use ($asignacion) {
                    return $nueva['materia_id'] == $asignacion->materia_id;
                });

                if (!$existe) {
                    // Verifica si esta asignación tiene dependencias (como horarios)
                    $tieneHorarios = $asignacion->horarios()->exists(); // Asegúrate de tener esta relación en el modelo

                    if (!$tieneHorarios) {
                        $asignacion->delete();
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Asignaciones actualizadas con éxito',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el grupo: ' . $e->getMessage(),
            ]);
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

            if ($subject->asignaciones()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la materia porque tiene asignaciones activas.',
                ], 409); // Conflict
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

    // Enrollment Functions
    public function storeEnrollment(Request $request)
    {
        try {
            $request->validate([
                'estudiante_id' => 'required|exists:estudiantes,estudiante_id',
                'grupo_id' => 'required|exists:grupos,grupo_id',
                'matricula_año' => 'required|numeric|between:1900,' . ((int) date('Y') + 2),
            ], [
                'estudiante_id.required' => 'El ID del estudiante es requerido',
                'estudiante_id.exists' => 'El estudiante no existe',
                'grupo_id.required' => 'El ID del grupo es requerido',
                'grupo_id.exists' => 'El grupo no existe',
                'matricula_año.required' => 'El año de matrícula es requerido',
                'matricula_año.numeric' => 'El año de matrícula debe ser numérico',
            ]);

            $existingEnrollment = Matricula::with('grupo')
                ->where('estudiante_id', $request->input('estudiante_id'))
                ->where('matricula_año', $request->input('matricula_año'))
                ->first();

            if ($existingEnrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'El estudiante ya está matriculado en este periodo académico (' . $existingEnrollment->matricula_año . ') en el grupo ' . $existingEnrollment->grupo->grupo_nombre . '.',
                ], 409);
            }

            $group = Grupo::find($request->input('grupo_id'));

            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Grupo no encontrado',
                ], 404);
            }

            if ($group->matriculas()->count() >= $group->grupo_cupo) {
                return response()->json([
                    'success' => false,
                    'message' => 'El grupo ' . $group->grupo_nombre . ' ya ha alcanzado su cupo máximo de estudiantes.',
                ], 409);
            }

            $enrollment = Matricula::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Matrícula creada con éxito',
                'data' => $enrollment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la matrícula: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateEnrollment(Request $request, $id)
    {
        try {
            $enrollment = Matricula::find($id);

            if (!$enrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Matrícula no encontrada',
                ], 404);
            }

            $request->validate([
                'grupo_id' => 'required|exists:grupos,grupo_id',
                'matricula_año' => 'required|numeric',
            ], [
                'grupo_id.required' => 'El ID del grupo es requerido',
                'grupo_id.exists' => 'El grupo no existe',
                'matricula_año.required' => 'El año de matrícula es requerido',
                'matricula_año.numeric' => 'El año de matrícula debe ser numérico',
            ]);

            // Check if the student is already enrolled in the same group and year
            $existingEnrollment = Matricula::where('estudiante_id', $enrollment->estudiante_id)
                ->where('grupo_id', $request->input('grupo_id'))
                ->where('matricula_año', $enrollment->matricula_año)
                ->first();

            if ($existingEnrollment && $existingEnrollment->matricula_id != $id) {
                return response()->json([
                    'success' => false,
                    'message' => 'El estudiante ya está matriculado en este grupo para el año ' . $enrollment->matricula_año . '.',
                ], 409);
            }

            $enrollment->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Matrícula actualizada con éxito',
                'data' => $enrollment,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la matrícula: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyEnrollment($id)
    {
        try {
            $enrollment = Matricula::find($id);

            if (!$enrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Matrícula no encontrada',
                ], 404);
            }

            // Add any dependency checks here if needed, e.g., if there are grades associated
            // if ($enrollment->notas()->exists()) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'No se puede eliminar la matrícula porque tiene notas asociadas.',
            //     ], 409); // Conflict
            // }

            $enrollment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Matrícula eliminada con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la matrícula: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Schedule functions
    public function storeBlock(Request $request)
    {
        try {
            $request->validate([
                'bloque_dia' => 'required|string|max:255',
                'bloque_inicio' => 'required|date_format:H:i',
                'bloque_fin' => 'required|date_format:H:i|after:bloque_inicio',
                'institucion_id' => 'required|exists:instituciones,institucion_id',
            ], [
                'bloque_dia.required' => 'El día del bloque es requerido',
                'bloque_dia.string' => 'El día del bloque debe ser una cadena de caracteres',
                'bloque_dia.max' => 'El día del bloque no puede exceder los 255 caracteres',
                'bloque_inicio.required' => 'La hora de inicio es requerida',
                'bloque_inicio.date_format' => 'La hora de inicio debe tener el formato HH:mm',
                'bloque_fin.required' => 'La hora de fin es requerida',
                'bloque_fin.date_format' => 'La hora de fin debe tener el formato HH:mm',
                'bloque_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio',
                'institucion_id.required' => 'La institución es requerida',
                'institucion_id.exists' => 'La institución no existe',
            ]);

            $block = Bloque::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Bloque creado con éxito',
                'data' => $block,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el bloque: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateBlock(Request $request, $id)
    {
        try {
            // dd($request->all()); // format "19:00:00"
            $request->validate([
                'bloque_dia' => 'sometimes|required|string|max:255',
                'bloque_inicio' => 'sometimes|required|date_format:H:i',
                'bloque_fin' => 'sometimes|required|date_format:H:i|after:bloque_inicio',
            ], [
                'bloque_dia.required' => 'El día del bloque es requerido',
                'bloque_dia.string' => 'El día del bloque debe ser una cadena de caracteres',
                'bloque_dia.max' => 'El día del bloque no puede exceder los 255 caracteres',
                'bloque_inicio.required' => 'La hora de inicio es requerida',
                'bloque_inicio.date_format' => 'La hora de inicio debe tener el formato HH:mm:ss',
                'bloque_fin.required' => 'La hora de fin es requerida',
                'bloque_fin.date_format' => 'La hora de fin debe tener el formato HH:mm:ss',
                'bloque_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio',
            ]);

            $block = Bloque::find($id);

            if (!$block) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bloque no encontrado',
                ], 404);
            }

            $block->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Bloque actualizado con éxito',
                'data' => $block,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el bloque: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyBlock($id)
    {
        try {
            $block = Bloque::find($id);

            if (!$block) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bloque no encontrado',
                ], 404);
            }

            if ($block->horarios()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar el bloque porque está en uso en horarios.',
                ], 409);
            }

            $block->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bloque eliminado con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el bloque: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function storeSchedule(Request $request)
    {
        try {
            $request->validate([
                'asignacion_id' => 'required|exists:asignaciones,asignacion_id',
                'bloque_id' => 'required|exists:bloques,bloque_id',
            ], [
                'asignacion_id.required' => 'La asignación es requerida',
                'asignacion_id.exists' => 'La asignación no existe',
                'bloque_id.required' => 'El bloque es requerido',
                'bloque_id.exists' => 'El bloque no existe',
            ]);

            $asignacion = Asignacion::find($request->input('asignacion_id'));

            if (!$asignacion) {
                return response()->json([
                    'success' => false,
                    'message' => 'Asignación no encontrada',
                ], 404);
            }

            $bloque = Bloque::find($request->input('bloque_id'));

            if (!$bloque) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bloque no encontrado',
                ], 404);
            }

            $existingSchedule = Horario::with('asignacion')
                ->where('bloque_id', $bloque->bloque_id)
                ->whereHas('asignacion', function ($query) use ($asignacion) {
                    $query->where('docente_id', $asignacion->docente_id);
                })->first();

            if ($existingSchedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'El docente ya tiene una clase programada en este horario.',
                ], 409);
            }

            $schedule = Horario::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Horario creado con éxito',
                'data' => $schedule,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el horario: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateSchedule(Request $request, $id)
    {
        try {
            $request->validate([
                'asignacion_id' => 'sometimes|required|exists:asignaciones,asignacion_id',
                'horario_dia' => 'sometimes|required|date',
            ]);

            $schedule = Horario::find($id);

            if (!$schedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'Horario no encontrado',
                ], 404);
            }

            $asignacion = Asignacion::find($request->input('asignacion_id'));
            if (!$asignacion) {
                return response()->json([
                    'success' => false,
                    'message' => 'Asignación no encontrada',
                ], 404);
            }

            $existingSchedule = Horario::with('asignacion')
                ->where('bloque_id', $schedule->bloque_id)
                ->whereHas('asignacion', function ($query) use ($asignacion) {
                    $query->where('docente_id', $asignacion->docente_id);
                })
                ->where('horario_id', '!=', $id)
                ->first();
            if ($existingSchedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'El docente ya tiene una clase programada en este horario.',
                ], 409);
            }

            $schedule->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Horario actualizado con éxito',
                'data' => $schedule,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el horario: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroySchedule($id)
    {
        try {
            $schedule = Horario::find($id);

            if (!$schedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'Horario no encontrado',
                ], 404);
            }

            $schedule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Horario eliminado con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el horario: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Absences functions
    public function storeAbsence(Request $request)
    {
        try {
            $request->validate([
                'institucion_id' => 'required|exists:instituciones,institucion_id',
                'matricula_id' => 'required|exists:matriculas,matricula_id',
                'inasistencia_fecha' => 'required|date',
                'inasistencia_justificada' => 'required|boolean',
                'inasistencia_motivo' => 'nullable|string',
            ]);

            $absence = Inasistencia::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Inasistencia creada con éxito',
                'data' => $absence,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la inasistencia: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateAbsence(Request $request, $id)
    {
        try {
            $request->validate([
                'inasistencia_fecha' => 'required|date',
                'inasistencia_justificada' => 'required|boolean',
                'inasistencia_motivo' => 'nullable|string',
            ], [
                'inasistencia_fecha.required' => 'La fecha de la inasistencia es requerida',
                'inasistencia_fecha.date' => 'La fecha de la inasistencia debe ser una fecha válida',
                'inasistencia_justificada.required' => 'El estado de justificación es requerido',
                'inasistencia_justificada.boolean' => 'El estado de justificación debe ser verdadero o falso',
                'inasistencia_motivo.string' => 'El motivo de la inasistencia debe ser una cadena de caracteres',
            ]);

            $absence = Inasistencia::find($id);

            if (!$absence) {
                return response()->json([
                    'success' => false,
                    'message' => 'Inasistencia no encontrada',
                ], 404);
            }

            $absence->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Inasistencia actualizada con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la inasistencia: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyAbsence($id)
    {
        try {
            $absence = Inasistencia::find($id);

            if (!$absence) {
                return response()->json([
                    'success' => false,
                    'message' => 'Inasistencia no encontrada',
                ], 404);
            }

            $absence->delete();

            return response()->json([
                'success' => true,
                'message' => 'Inasistencia eliminada con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la inasistencia: ' . $e->getMessage(),
            ], 500);
        }
    }
}
