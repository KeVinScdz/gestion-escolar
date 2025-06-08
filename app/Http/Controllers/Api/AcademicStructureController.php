<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\PeriodoAcademico;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Asignacion;
use App\Models\Horario;
use App\Models\Bloque;
use App\Models\Docente;
use App\Models\Asistencia;
use App\Models\Estudiante;
use App\Models\Institucion;
use App\Models\Matricula;
use App\Models\Nota;
use App\Models\Observacion;
use App\Models\Pago;
use App\Models\SolicitudEstudiante;
use App\Models\SolicitudMatricula;
use App\Models\SolicitudTutor;
use App\Models\Tutor;
use App\Models\Usuario;

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

    // Enrollment Request Functions
    public function storeEnrollmentRequest(Request $request)
    {
        try {
            $data = $request->all();

            DB::beginTransaction();

            $request->validate([
                'institucion_id' => 'required|exists:instituciones,institucion_id',
                'grado_id' => 'required|exists:grados,grado_id',
                'solicitud_año' => 'required|numeric',
                'estudiante_existente' => 'required|string',
                'solicitud_comentario' => 'required|string',
                'tutor_nombre' => 'required|string',
                'tutor_apellido' => 'required|string',
                'tutor_documento_tipo' => 'required|string',
                'tutor_documento' => 'required|string',
                'tutor_direccion' => 'required|string',
                'tutor_telefono' => 'required|string',
                'tutor_correo' => 'required|email',
            ], [
                'institucion_id.required' => 'La institución es requerida',
                'institucion_id.exists' => 'La institución no existe',
                'grado_id.required' => 'El grado es requerido',
                'grado_id.exists' => 'El grado no existe',
                'solicitud_año.required' => 'El año de solicitud es requerido',
                'solicitud_año.numeric' => 'El año de solicitud debe ser numérico',
                'estudiante_existente.required' => 'El estudiante existe es requerido',
                'estudiante_existente.string' => 'El estudiante existe debe ser una cadena de caracteres',
                'solicitud_comentario.required' => 'El comentario es requerido',
                'tutor_nombre.required' => 'El nombre del tutor es requerido',
                'tutor_nombre.string' => 'El nombre del tutor debe ser una cadena de caracteres',
                'tutor_apellido.required' => 'El apellido del tutor es requerido',
                'tutor_apellido.string' => 'El apellido del tutor debe ser una cadena de caracteres',
                'tutor_documento_tipo.required' => 'El tipo de documento del tutor es requerido',
                'tutor_documento_tipo.string' => 'El tipo de documento del tutor debe ser una cadena de caracteres',
                'tutor_documento.required' => 'El documento del tutor es requerido',
                'tutor_direccion.required' => 'La dirección del tutor es requerida',
                'tutor_direccion.string' => 'La dirección del tutor debe ser una cadena de caracteres',
                'tutor_telefono.required' => 'El teléfono del tutor es requerido',
                'tutor_telefono.string' => 'El teléfono del tutor debe ser una cadena de caracteres',
                'tutor_correo.required' => 'El correo del tutor es requerido',
                'tutor_correo.email' => 'El correo del tutor debe ser una dirección de correo electrónico válida',
            ]);

            $solicitud = SolicitudMatricula::create([
                'institucion_id' => $data['institucion_id'],
                'grado_id' => $data['grado_id'],
                'solicitud_año' => $data['solicitud_año'],
                'solicitud_estado' => 'pendiente',
                'solicitud_comentario' => $data['solicitud_comentario'],
            ]);

            $tutor = SolicitudTutor::create([
                'solicitud_id' => $solicitud->solicitud_id,
                'tutor_nombre' => $data['tutor_nombre'],
                'tutor_apellido' => $data['tutor_apellido'],
                'tutor_documento_tipo' => $data['tutor_documento_tipo'],
                'tutor_documento' => $data['tutor_documento'],
                'tutor_direccion' => $data['tutor_direccion'],
                'tutor_telefono' => $data['tutor_telefono'],
                'tutor_correo' => $data['tutor_correo'],
            ]);

            // buscar usuario por documento
            if ($data['estudiante_existente'] === "si") {
                $student = Estudiante::with('usuario')
                    ->whereHas('usuario', function ($query) use ($data) {
                        $query->where('usuario_documento', $data['estudiante_documento_existente'])
                            ->where('rol_id', 4);
                    })
                    ->first();

                if (!$student) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Estudiante no encontrado',
                    ], 404);
                }

                $existingRequest = SolicitudMatricula::where('estudiante_id', $student->estudiante_id)
                    ->where('solicitud_estado', 'pendiente')
                    ->first();

                if ($existingRequest) {
                    return response()->json([
                        'success' => false,
                        'message' => 'El estudiante ya tiene una solicitud de matrícula pendiente',
                    ], 409);
                }

                $existingEnrollment = Matricula::where('estudiante_id', $student->estudiante_id)
                    ->where('matricula_año', $data['solicitud_año'])
                    ->first();

                if ($existingEnrollment) {
                    return response()->json([
                        'success' => false,
                        'message' => 'El estudiante ya está matriculado en este año (' . $existingEnrollment->matricula_año . ')',
                    ], 409);
                }

                $solicitud->estudiante_id = $student->estudiante_id;
                $solicitud->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Estudiante encontrado y asignado a la solicitud',
                    'data' => $student,
                ], 201);
            }

            $request->validate([
                'estudiante_nombre' => 'required|string',
                'estudiante_apellido' => 'required|string',
                'estudiante_documento_tipo' => 'required|string',
                'estudiante_documento' => 'required|string',
                'estudiante_nacimiento' => 'required|date',
            ], [
                'estudiante_nombre.required' => 'El nombre del estudiante es requerido',
                'estudiante_nombre.string' => 'El nombre del estudiante debe ser una cadena de caracteres',
                'estudiante_apellido.required' => 'El apellido del estudiante es requerido',
                'estudiante_apellido.string' => 'El apellido del estudiante debe ser una cadena de caracteres',
                'estudiante_documento_tipo.required' => 'El tipo de documento del estudiante es requerido',
                'estudiante_documento_tipo.string' => 'El tipo de documento del estudiante debe ser una cadena de caracteres',
                'estudiante_documento.required' => 'El documento del estudiante es requerido',
                'estudiante_documento.string' => 'El documento del estudiante debe ser una cadena de caracteres',
                'estudiante_nacimiento.required' => 'La fecha de nacimiento del estudiante es requerida',
                'estudiante_nacimiento.date' => 'La fecha de nacimiento del estudiante debe ser una fecha',
            ]);

            // validar si el estudiante ya hay un solicitudEstudiante con el mismo documento y su solicitud este pendiente
            $existingStudentRequest = SolicitudEstudiante::with('solicitud')
                ->where('estudiante_documento', $data['estudiante_documento'])
                ->whereHas('solicitud', function ($query) {
                    $query->where('solicitud_estado', 'pendiente');
                })
                ->first();

            if ($existingStudentRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'El estudiante ya tiene una solicitud de matrícula pendiente',
                ], 409);
            }

            $student = SolicitudEstudiante::create([
                'solicitud_id' => $solicitud->solicitud_id,
                'estudiante_nombre' => $data['estudiante_nombre'],
                'estudiante_apellido' => $data['estudiante_apellido'],
                'estudiante_documento_tipo' => $data['estudiante_documento_tipo'],
                'estudiante_documento' => $data['estudiante_documento'],
                'estudiante_nacimiento' => $data['estudiante_nacimiento'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Solicitud de matrícula creada con éxito',
                'data' => null,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al crear la solicitud de matrícula: ' . $e->getMessage(),
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateEnrollmentRequest(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'grupo_id' => 'required|exists:grupos,grupo_id',
                'matricula_año' => 'required|numeric',
                'es_nuevo' => 'required|boolean',
            ], [
                'grupo_id.required' => 'El ID del grupo es requerido',
                'grupo_id.exists' => 'El grupo no existe',
                'matricula_año.required' => 'El año de matrícula es requerido',
                'matricula_año.numeric' => 'El año de matrícula debe ser numérico',
                'es_nuevo.required' => 'El estado de la solicitud es requerido',
                'es_nuevo.boolean' => 'El estado de la solicitud debe ser un booleano',
            ]);

            $solicitud = SolicitudMatricula::find($id);
            $estudiante = null;

            if (!$solicitud) {
                return response()->json([
                    'success' => false,
                    'message' => 'Solicitud de matrícula no encontrada',
                ], 404);
            }

            if ($request->input('es_nuevo')) {
                $request->validate([
                    'estudiante_nombre' => 'required|string',
                    'estudiante_apellido' => 'required|string',
                    'estudiante_correo' => 'required|email',
                    'estudiante_documento_tipo' => 'required|string',
                    'estudiante_documento' => 'required|string',
                    'estudiante_nacimiento' => 'required|date',
                    'estudiante_direccion' => 'required|string',
                    'estudiante_telefono' => 'required|string',
                    'estudiante_contra' => 'required|string',
                    'tutor_nombre' => 'required|string',
                    'tutor_apellido' => 'required|string',
                    'tutor_correo' => 'required|email',
                    'tutor_documento_tipo' => 'required|string',
                    'tutor_documento' => 'required|string',
                    'tutor_nacimiento' => 'required|date',
                    'tutor_direccion' => 'required|string',
                    'tutor_telefono' => 'required|string',
                    'tutor_contra' => 'required|string',
                ], [
                    'estudiante_nombre.required' => 'El nombre del estudiante es requerido',
                    'estudiante_nombre.string' => 'El nombre del estudiante debe ser una cadena de caracteres',
                    'estudiante_apellido.required' => 'El apellido del estudiante es requerido',
                    'estudiante_apellido.string' => 'El apellido del estudiante debe ser una cadena de caracteres',
                    'estudiante_correo.required' => 'El correo del estudiante es requerido',
                    'estudiante_correo.email' => 'El correo del estudiante debe ser una dirección de correo electrónico válida',
                    'estudiante_documento_tipo.required' => 'El tipo de documento del estudiante es requerido',
                    'estudiante_documento.required' => 'El documento del estudiante es requerido',
                    'estudiante_documento.string' => 'El documento del estudiante debe ser una cadena de caracteres',
                    'estudiante_nacimiento.required' => 'La fecha de nacimiento del estudiante es requerida',
                    'estudiante_nacimiento.date' => 'La fecha de nacimiento del estudiante debe ser una fecha',
                    'estudiante_direccion.required' => 'La dirección del estudiante es requerida',
                    'estudiante_direccion.string' => 'La dirección del estudiante debe ser una cadena de caracteres',
                    'estudiante_telefono.required' => 'El teléfono del estudiante es requerido',
                    'estudiante_telefono.string' => 'El teléfono del estudiante debe ser una cadena de caracteres',
                    'estudiante_contra.required' => 'La contraseña del estudiante es requerida',
                    'estudiante_contra.string' => 'La contraseña del estudiante debe ser una cadena de caracteres',
                    'tutor_nombre.required' => 'El nombre del tutor es requerido',
                    'tutor_nombre.string' => 'El nombre del tutor debe ser una cadena de caracteres',
                    'tutor_apellido.required' => 'El apellido del tutor es requerido',
                    'tutor_apellido.string' => 'El apellido del tutor debe ser una cadena de caracteres',
                    'tutor_correo.required' => 'El correo del tutor es requerido',
                    'tutor_correo.email' => 'El correo del tutor debe ser una dirección de correo electrónico válida',
                    'tutor_documento_tipo.required' => 'El tipo de documento del tutor es requerido',
                    'tutor_documento_tipo.string' => 'El tipo de documento del tutor debe ser una cadena de caracteres',
                    'tutor_documento.required' => 'El documento del tutor es requerido',
                    'tutor_documento.string' => 'El documento del tutor debe ser una cadena de caracteres',
                    'tutor_nacimiento.required' => 'La fecha de nacimiento del tutor es requerida',
                    'tutor_nacimiento.date' => 'La fecha de nacimiento del tutor debe ser una fecha',
                    'tutor_direccion.required' => 'La dirección del tutor es requerida',
                    'tutor_direccion.string' => 'La dirección del tutor debe ser una cadena de caracteres',
                    'tutor_telefono.required' => 'El teléfono del tutor es requerido',
                    'tutor_telefono.string' => 'El teléfono del tutor debe ser una cadena de caracteres',
                    'tutor_contra.required' => 'La contraseña del tutor es requerida',
                    'tutor_contra.string' => 'La contraseña del tutor debe ser una cadena de caracteres',
                ]);

                $estudianteUsuario = Usuario::create([
                    'usuario_nombre' => $request->input('estudiante_nombre'),
                    'usuario_apellido' => $request->input('estudiante_apellido'),
                    'usuario_correo' => $request->input('estudiante_correo'),
                    'usuario_documento_tipo' => $request->input('estudiante_documento_tipo'),
                    'usuario_documento' => $request->input('estudiante_documento'),
                    'usuario_nacimiento' => $request->input('estudiante_nacimiento'),
                    'usuario_direccion' => $request->input('estudiante_direccion'),
                    'usuario_telefono' => $request->input('estudiante_telefono'),
                    'usuario_contra' => $request->input('estudiante_contra'),
                    'rol_id' => 4,
                ]);

                $tutorUsuario = Usuario::create([
                    'usuario_nombre' => $request->input('tutor_nombre'),
                    'usuario_apellido' => $request->input('tutor_apellido'),
                    'usuario_correo' => $request->input('tutor_correo'),
                    'usuario_documento_tipo' => $request->input('tutor_documento_tipo'),
                    'usuario_documento' => $request->input('tutor_documento'),
                    'usuario_nacimiento' => $request->input('tutor_nacimiento'),
                    'usuario_direccion' => $request->input('tutor_direccion'),
                    'usuario_telefono' => $request->input('tutor_telefono'),
                    'usuario_contra' => $request->input('tutor_contra'),
                    'rol_id' => 5,
                ]);

                $estudiante = Estudiante::create([
                    'usuario_id' => $estudianteUsuario->usuario_id,
                    'institucion_id' => $request->input('institucion_id'),
                ]);

                $tutor = Tutor::create([
                    'usuario_id' => $tutorUsuario->usuario_id,
                    'estudiante_id' => $estudiante->estudiante_id,
                ]);
            } else {
                $estudiante = Estudiante::find($request->input('estudiante_id'));

                if (!$estudiante) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Estudiante no encontrado',
                    ], 404);
                }

                $matricula = Matricula::where('estudiante_id', $estudiante->estudiante_id)
                    ->where('matricula_año', $request->input('matricula_año'))
                    ->first();

                if ($matricula) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'message' => 'El estudiante ya está matriculado en este año (' . $matricula->matricula_año . ')',
                    ], 409);
                }
            }

            $grupo = Grupo::find($request->input('grupo_id'));

            if (!$grupo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Grupo no encontrado',
                ], 404);
            }

            if ($grupo->grupo_cupo - $grupo->matriculas->count() <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay cupos disponibles para este grupo',
                ], 409);
            }

            $matricula = Matricula::create([
                'estudiante_id' => $estudiante->estudiante_id,
                'grupo_id' => $request->input('grupo_id'),
                'matricula_año' => $request->input('matricula_año'),
            ]);

            $solicitud->update(['solicitud_estado' => 'aprobada']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Solicitud de matrícula actualizada con éxito',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la solicitud de matrícula: ' . $e->getMessage(),
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

    // Observations functions
    public function storeObservation(Request $request)
    {
        try {
            $request->validate(
                [
                    'matricula_id' => 'required|exists:matriculas,matricula_id',
                    'observacion_tipo' => 'required|string',
                    'observacion_descripcion' => 'required|string',
                    'observacion_fecha' => 'required|date',
                ],
                [
                    'matricula_id.required' => 'El ID de matrícula es requerido',
                    'matricula_id.exists' => 'La matrícula no existe',
                    'institucion_id.required' => 'El ID de institución es requerido',
                    'institucion_id.exists' => 'La institución no existe',
                    'observacion_tipo.required' => 'El tipo de observación es requerido',
                    'observacion_tipo.string' => 'El tipo de observación debe ser una cadena de caracteres',
                    'observacion_descripcion.required' => 'La descripción de la observación es requerida',
                    'observacion_descripcion.string' => 'La descripción de la observación debe ser una cadena de caracteres',
                    'observacion_fecha.required' => 'La fecha de la observación es requerida',
                    'observacion_fecha.date' => 'La fecha de la observación debe ser una fecha válida',
                ]
            );

            $observation = Observacion::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Observación creada con éxito',
                'data' => $observation,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la observación: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateObservation(Request $request, $id)
    {
        try {
            $request->validate([
                'observacion_tipo' => 'sometimes|required|string',
                'observacion_descripcion' => 'sometimes|required|string',
                'observacion_fecha' => 'sometimes|required|date',
            ], [
                'observacion_tipo.required' => 'El tipo de observación es requerido',
                'observacion_tipo.string' => 'El tipo de observación debe ser una cadena de caracteres',
                'observacion_descripcion.required' => 'La descripción de la observación es requerida',
                'observacion_descripcion.string' => 'La descripción de la observación debe ser una cadena de caracteres',
                'observacion_fecha.required' => 'La fecha de la observación es requerida',
                'observacion_fecha.date' => 'La fecha de la observación debe ser una fecha válida',
            ]);

            $observation = Observacion::find($id);

            if (!$observation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Observación no encontrada',
                ], 404);
            }

            $observation->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Observación actualizada con éxito',
                'data' => $observation,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la observación: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyObservation($id)
    {
        try {
            $observation = Observacion::find($id);

            if (!$observation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Observación no encontrada',
                ], 404);
            }

            $observation->delete();

            return response()->json([
                'success' => true,
                'message' => 'Observación eliminada con éxito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la observación: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Attendance functions
    public function storeAttendance(Request $request)
    {
        try {
            $request->validate(
                [
                    'asignacion_id' => 'required|exists:asignaciones,asignacion_id',
                    'asistencia_fecha' => 'required|date',
                ]
            );

            $asignacionDB = Asignacion::find($request->input('asignacion_id'));
            $asistenciasDB = Asistencia::with('matricula')
                ->where('asistencia_fecha', $request->input('asistencia_fecha'))
                ->whereHas('matricula', function ($query) use ($asignacionDB) {
                    $query->where('grupo_id', $asignacionDB->grupo_id);
                })->get();

            $asistencias = [];

            if (count($request->input('asistencias_estados')) !== count($request->input('matriculas')) && count($request->input('asistencias_estados')) !== count($request->input('justificaciones'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'El número de asistencias no coincide con el número de matrículas o no se proporcionaron justificaciones.',
                ], 400);
            }

            foreach ($request->input('matriculas') as $index => $matricula_id) {
                $asistencias[] = [
                    'asistencia_id' => Str::uuid()->toString(),
                    'matricula_id' => $matricula_id,
                    'asistencia_fecha' => $request->input('asistencia_fecha'),
                    'asistencia_estado' => $request->input('asistencias_estados')[$index],
                    'asistencia_motivo' => $request->input('justificaciones')[$index] ?? null,
                ];
            }

            if (count($asistenciasDB) > 0) {
                foreach ($asistencias as $asistencia) {
                    $existingAsistencia = $asistenciasDB->firstWhere('matricula_id', $asistencia['matricula_id']);
                    if ($existingAsistencia) {
                        unset($asistencia['asistencia_id']);
                        $existingAsistencia->update($asistencia);
                    } else {
                        Asistencia::create($asistencia);
                    }
                }
            } else {
                Asistencia::insert($asistencias);
            }

            return response()->json([
                'success' => true,
                'message' => $asistenciasDB->isEmpty() ? 'Asistencia creada con éxito' : 'Asistencia actualizada con éxito',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la asistencia: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateAttendance(Request $request, $id)
    {
        try {
            $attendance = Asistencia::find($id);

            if (!$attendance) {
                return response()->json([
                    'success' => false,
                    'message' => 'Asistencia no encontrada',
                ], 404);
            }

            $attendance->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Asistencia actualizada con éxito',
                'data' => $attendance,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la asistencia: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Grades functions
    public function storeGrade(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate(
                [
                    'asignacion_id' => 'required|exists:asignaciones,asignacion_id',
                    'notas' => 'required|array',
                    'matriculas' => 'required|array',
                    'periodos' => 'required|array',
                ]
            );

            $asignacionDB = Asignacion::with('materia')->find($request->input('asignacion_id'));
            $institucionDB = Institucion::find($asignacionDB->materia->institucion_id);
            $notasDB = Nota::with('asignacion')
                ->whereHas('asignacion', function ($query) use ($asignacionDB) {
                    $query->where('asignacion_id', $asignacionDB->asignacion_id);
                })->get();

            $notas = [];

            if (count($request->input('notas')) !== count($request->input('matriculas')) || count($request->input('notas')) !== count($request->input('periodos'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'El número de notas no coincide con el número de matrículas o periodos.',
                ], 400);
            }

            foreach ($request->input('matriculas') as $index => $matricula_id) {
                if (!isset($request->input('notas')[$index]) || !isset($request->input('periodos')[$index])) {
                    $existingGrade = $notasDB->where('matricula_id', $matricula_id)->where('periodo_academico_id', $request->input('periodos')[$index])->first();
                    if ($existingGrade) {
                        $existingGrade->delete();
                    }
                    continue;
                }

                if ($request->input('notas')[$index] < $institucionDB->nota_minima || $request->input('notas')[$index] > $institucionDB->nota_maxima) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'La nota debe estar entre ' . $institucionDB->nota_minima . ' y ' . $institucionDB->nota_maxima,
                    ], 400);
                }

                $notas[] = [
                    'nota_id' => Str::uuid()->toString(),
                    'matricula_id' => $matricula_id,
                    'asignacion_id' => $request->input('asignacion_id'),
                    'periodo_academico_id' => $request->input('periodos')[$index],
                    'nota_valor' => $request->input('notas')[$index],
                ];
            }

            if (count($notasDB) > 0) {
                foreach ($notas as $nota) {
                    $existingNota = $notasDB->where('matricula_id', $nota['matricula_id'])->where('periodo_academico_id', $nota['periodo_academico_id'])->first();
                    if ($existingNota) {
                        unset($nota['nota_id']);

                        $existingNota->update($nota);
                    } else {
                        Nota::create($nota);
                    }
                }
            } else {
                Nota::insert($notas);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $notasDB->isEmpty() ? 'Notas creadas con éxito' : 'Notas actualizadas con éxito',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear las notas: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Payments functions
    public function storePayment(Request $request)
    {
        try {
            $request->validate([
                'matricula_id' => 'required|exists:matriculas,matricula_id',
                'concepto_id' => 'required|exists:conceptos_pago,concepto_id',
                'pago_fecha' => 'required|date',
                'pago_valor' => 'required|numeric',
                'pago_estado' => 'required|string',
            ], [
                'matricula_id.required' => 'El ID de matrícula es requerido',
                'matricula_id.exists' => 'La matrícula no existe',
                'concepto_id.required' => 'El ID de concepto es requerido',
                'concepto_id.exists' => 'El concepto no existe',
                'pago_fecha.required' => 'La fecha de pago es requerida',
                'pago_fecha.date' => 'La fecha de pago debe ser una fecha válida',
                'pago_valor.required' => 'El valor de pago es requerido',
                'pago_valor.numeric' => 'El valor de pago debe ser un número',
                'pago_estado.required' => 'El estado de pago es requerido',
                'pago_estado.string' => 'El estado de pago debe ser una cadena de caracteres',
            ]);

            $existingPayment = Pago::where('matricula_id', $request->input('matricula_id'))->where('concepto_id', $request->input('concepto_id'))->first();

            if ($existingPayment) {
                return response()->json([
                    'success' => false,
                    'message' => 'El pago ya existe',
                ], 400);
            }

            $payment = Pago::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Pago creado con éxito',
                'data' => $payment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el pago: ' . $e->getMessage(),
            ], 500);
        }
    }
}
