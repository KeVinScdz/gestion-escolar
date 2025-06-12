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

/**
* @OA\Info(
*             title="Documentacion API",
*             version="1.0",
*             description="Descripcion"
* )
*
* @OA\Server(url="http://localhost:8000")
*/


class AcademicStructureController
{
    /**
 * Crea un nuevo período académico
 * 
 * @OA\Post(
 *     path="/ api/attendances",
 *     tags={"Periodos Académicos"},
 *     summary="Crear un nuevo período académico",
 *     description="Registra un nuevo período académico con año, fechas de inicio/fin e institución asociada",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"periodo_academico_año", "periodo_academico_inicio", "periodo_academico_fin", "institucion_id"},
 *             @OA\Property(property="periodo_academico_año", type="integer", example=2023, description="Año del período académico"),
 *             @OA\Property(property="periodo_academico_inicio", type="string", format="date", example="2023-03-01", description="Fecha de inicio del período"),
 *             @OA\Property(property="periodo_academico_fin", type="string", format="date", example="2023-12-15", description="Fecha de fin del período"),
 *             @OA\Property(property="institucion_id", type="integer", example=1, description="ID de la institución asociada")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Periodo creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Periodo creado con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="periodo_academico_id", type="integer", example=1),
 *                 @OA\Property(property="periodo_academico_año", type="integer", example=2023),
 *                 @OA\Property(property="periodo_academico_inicio", type="string", format="date", example="2023-03-01"),
 *                 @OA\Property(property="periodo_academico_fin", type="string", format="date", example="2023-12-15"),
 *                 @OA\Property(property="institucion_id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-03-01T12:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-03-01T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="periodo_academico_año",
 *                     type="array",
 *                     @OA\Items(type="string", example="El año es requerido")
 *                 ),
 *                 @OA\Property(
 *                     property="periodo_academico_inicio",
 *                     type="array",
 *                     @OA\Items(type="string", example="La fecha de inicio es requerida")
 *                 ),
 *                 @OA\Property(
 *                     property="periodo_academico_fin",
 *                     type="array",
 *                     @OA\Items(type="string", example="La fecha de fin debe ser una fecha válida")
 *                 ),
 *                 @OA\Property(
 *                     property="institucion_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="La institución no existe")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al crear el periodo: Mensaje de error específico")
 *         )
 *     )
 * )
 */
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
/**
 * Actualiza un período académico existente
 * 
 * @OA\Put(
 *     path="/api/attendances/{id}",
 *     tags={"Periodos Académicos"},
 *     summary="Actualizar un período académico",
 *     description="Actualiza la información de un período académico existente identificado por su ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del período académico a actualizar",
 *         required=true,
 *         @OA\Schema(type="integer", format="int64", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos del período académico a actualizar",
 *         @OA\JsonContent(
 *             required={"periodo_academico_año", "periodo_academico_inicio", "periodo_academico_fin"},
 *             @OA\Property(property="periodo_academico_año", type="integer", example=2024, description="Nuevo año del período académico"),
 *             @OA\Property(property="periodo_academico_inicio", type="string", format="date", example="2024-03-01", description="Nueva fecha de inicio"),
 *             @OA\Property(property="periodo_academico_fin", type="string", format="date", example="2024-12-20", description="Nueva fecha de fin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Periodo actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Periodo actualizado con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="periodo_academico_id", type="integer", example=1),
 *                 @OA\Property(property="periodo_academico_año", type="integer", example=2024),
 *                 @OA\Property(property="periodo_academico_inicio", type="string", format="date", example="2024-03-01"),
 *                 @OA\Property(property="periodo_academico_fin", type="string", format="date", example="2024-12-20"),
 *                 @OA\Property(property="institucion_id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-03-01T12:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-03-05T15:30:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Periodo no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Periodo no encontrado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="periodo_academico_año",
 *                     type="array",
 *                     @OA\Items(type="string", example="El año debe ser numérico")
 *                 ),
 *                 @OA\Property(
 *                     property="periodo_academico_inicio",
 *                     type="array",
 *                     @OA\Items(type="string", example="La fecha de inicio debe ser una fecha válida")
 *                 ),
 *                 @OA\Property(
 *                     property="periodo_academico_fin",
 *                     type="array",
 *                     @OA\Items(type="string", example="La fecha de fin es requerida")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al actualizar el periodo: Mensaje de error específico")
 *         )
 *     )
 * )
 */
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
/**
 * Elimina un período académico del sistema
 * 
 * @OA\Delete(
 *     path="/api/periods/{id}",
 *     tags={"Periodos Académicos"},
 *     summary="Eliminar período académico",
 *     description="Elimina permanentemente un período académico identificado por su ID",
 *     operationId="destroyPeriod",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del período académico a eliminar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Éxito en la operación",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Periodo eliminado con éxito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Recurso no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Periodo no encontrado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="Error al eliminar el periodo: Error específico del sistema"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */
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

    /**
 * Crea un nuevo grupo académico
 * 
 * @OA\Post(
 *     path="/api/groups",
 *     tags={"Grupos Académicos"},
 *     summary="Crear un nuevo grupo",
 *     description="Registra un nuevo grupo académico con nombre, año, cupo y relaciones con grado e institución",
 *     operationId="storeGroup",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos del grupo a crear",
 *         @OA\JsonContent(
 *             required={"grupo_nombre", "grupo_año", "grupo_cupo", "grado_id", "institucion_id"},
 *             @OA\Property(property="grupo_nombre", type="string", maxLength=255, example="Grupo A", description="Nombre del grupo"),
 *             @OA\Property(property="grupo_año", type="integer", example=2023, description="Año académico del grupo"),
 *             @OA\Property(property="grupo_cupo", type="integer", example=30, description="Cupo máximo de estudiantes"),
 *             @OA\Property(property="grado_id", type="integer", example=1, description="ID del grado asociado"),
 *             @OA\Property(property="institucion_id", type="integer", example=1, description="ID de la institución asociada")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Grupo creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Grupo creado con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="grupo_id", type="integer", example=1),
 *                 @OA\Property(property="grupo_nombre", type="string", example="Grupo A"),
 *                 @OA\Property(property="grupo_año", type="integer", example=2023),
 *                 @OA\Property(property="grupo_cupo", type="integer", example=30),
 *                 @OA\Property(property="grado_id", type="integer", example=1),
 *                 @OA\Property(property="institucion_id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-03-01T12:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-03-01T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="grupo_nombre",
 *                     type="array",
 *                     @OA\Items(type="string", example="El nombre debe ser una cadena de caracteres")
 *                 ),
 *                 @OA\Property(
 *                     property="grupo_año",
 *                     type="array",
 *                     @OA\Items(type="string", example="El año debe ser numérico")
 *                 ),
 *                 @OA\Property(
 *                     property="grupo_cupo",
 *                     type="array",
 *                     @OA\Items(type="string", example="El cupo debe ser numérico")
 *                 ),
 *                 @OA\Property(
 *                     property="grado_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="El grado no existe")
 *                 ),
 *                 @OA\Property(
 *                     property="institucion_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="La institución no existe")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al crear el grupo: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Actualiza un grupo académico existente
 * 
 * @OA\Put(
 *     path="/api/groups/{id}",
 *     tags={"Grupos Académicos"},
 *     summary="Actualizar un grupo",
 *     description="Actualiza la información de un grupo académico existente",
 *     operationId="updateGroup",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del grupo a actualizar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos del grupo a actualizar",
 *         @OA\JsonContent(
 *             required={"grupo_nombre", "grupo_año", "grupo_cupo"},
 *             @OA\Property(property="grupo_nombre", type="string", maxLength=255, example="Grupo B", description="Nuevo nombre del grupo"),
 *             @OA\Property(property="grupo_año", type="integer", example=2024, description="Nuevo año académico"),
 *             @OA\Property(property="grupo_cupo", type="integer", example=35, description="Nuevo cupo máximo")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Grupo actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Grupo actualizado con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="grupo_id", type="integer", example=1),
 *                 @OA\Property(property="grupo_nombre", type="string", example="Grupo B"),
 *                 @OA\Property(property="grupo_año", type="integer", example=2024),
 *                 @OA\Property(property="grupo_cupo", type="integer", example=35),
 *                 @OA\Property(property="grado_id", type="integer", example=1),
 *                 @OA\Property(property="institucion_id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-03-01T12:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-02-15T09:30:45Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Grupo no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Grupo no encontrado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="grupo_nombre",
 *                     type="array",
 *                     @OA\Items(type="string", example="El nombre debe ser una cadena de caracteres")
 *                 ),
 *                 @OA\Property(
 *                     property="grupo_año",
 *                     type="array",
 *                     @OA\Items(type="string", example="El año debe ser numérico")
 *                 ),
 *                 @OA\Property(
 *                     property="grupo_cupo",
 *                     type="array",
 *                     @OA\Items(type="string", example="El cupo debe ser numérico")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al actualizar el grupo: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Actualiza las asignaciones de materias y docentes a un grupo
 * 
 * @OA\Put(
 *     path="/api/groups/{id}/assignments",
 *     tags={"Grupos Académicos"},
 *     summary="Actualizar asignaciones de grupo",
 *     description="Asigna o actualiza docentes a materias en un grupo específico, eliminando asignaciones no utilizadas",
 *     operationId="updateGroupAssignments",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del grupo a actualizar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Asignaciones de materias y docentes",
 *         @OA\JsonContent(
 *             required={"materias", "docentes"},
 *             @OA\Property(
 *                 property="materias",
 *                 type="array",
 *                 @OA\Items(
 *                     type="integer",
 *                     example=1,
 *                     description="ID de la materia"
 *                 ),
 *                 example={1, 2, 3}
 *             ),
 *             @OA\Property(
 *                 property="docentes",
 *                 type="array",
 *                 @OA\Items(
 *                     type="integer",
 *                     example=1,
 *                     description="ID del docente"
 *                 ),
 *                 example={4, 5, 6}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Asignaciones actualizadas exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Asignaciones actualizadas con éxito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Solicitud incorrecta",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Las listas de materias y docentes deben tener la misma longitud")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Grupo no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Grupo no encontrado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al actualizar las asignaciones: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Elimina un grupo académico del sistema
 * 
 * @OA\Delete(
 *     path="/api/groups/{id}",
 *     tags={"Grupos Académicos"},
 *     summary="Eliminar grupo académico",
 *     description="Elimina permanentemente un grupo académico identificado por su ID. Esta acción no puede deshacerse.",
 *     operationId="destroyGroup",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del grupo a eliminar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Grupo eliminado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Grupo eliminado con éxito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Grupo no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Grupo no encontrado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflicto - Restricción de integridad",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="No se puede eliminar el grupo porque tiene asignaciones relacionadas"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="Error al eliminar el grupo: Mensaje de error específico"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Crea una nueva materia académica
 * 
 * @OA\Post(
 *     path="/api/subjects",
 *     tags={"Materias"},
 *     summary="Crear nueva materia",
 *     description="Registra una nueva materia académica en el sistema",
 *     operationId="storeSubject",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de la materia a crear",
 *         @OA\JsonContent(
 *             required={"materia_nombre", "institucion_id"},
 *             @OA\Property(
 *                 property="materia_nombre", 
 *                 type="string", 
 *                 maxLength=255,
 *                 example="Matemáticas Avanzadas",
 *                 description="Nombre de la materia"
 *             ),
 *             @OA\Property(
 *                 property="institucion_id", 
 *                 type="integer", 
 *                 example=1,
 *                 description="ID de la institución a la que pertenece la materia"
 *             ),
 *             @OA\Property(
 *                 property="materia_descripcion", 
 *                 type="string", 
 *                 example="Curso de matemáticas para nivel avanzado",
 *                 description="Descripción opcional de la materia",
 *                 nullable=true
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Materia creada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Materia creada con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="materia_id", type="integer", example=1),
 *                 @OA\Property(property="materia_nombre", type="string", example="Matemáticas Avanzadas"),
 *                 @OA\Property(property="institucion_id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-03-01T12:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-03-01T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="materia_nombre",
 *                     type="array",
 *                     @OA\Items(type="string", example="El nombre de la materia es requerido")
 *                 ),
 *                 @OA\Property(
 *                     property="institucion_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="La institución seleccionada no existe")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al crear la materia: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Actualiza una materia académica existente
 * 
 * @OA\Put(
 *     path="/api/subjects/{id}",
 *     tags={"Materias"},
 *     summary="Actualizar materia existente",
 *     description="Actualiza la información de una materia académica identificada por su ID",
 *     operationId="updateSubject",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la materia a actualizar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de la materia a actualizar",
 *         @OA\JsonContent(
 *             required={"materia_nombre"},
 *             @OA\Property(
 *                 property="materia_nombre", 
 *                 type="string", 
 *                 maxLength=255,
 *                 example="Matemáticas Superiores",
 *                 description="Nuevo nombre de la materia"
 *             ),
 *             @OA\Property(
 *                 property="materia_descripcion", 
 *                 type="string", 
 *                 example="Curso actualizado de matemáticas avanzadas",
 *                 description="Nueva descripción de la materia",
 *                 nullable=true
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Materia actualizada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Materia actualizada con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="materia_id", type="integer", example=1),
 *                 @OA\Property(property="materia_nombre", type="string", example="Matemáticas Superiores"),
 *                 @OA\Property(property="institucion_id", type="integer", example=1),
 *                 @OA\Property(property="materia_descripcion", type="string", example="Curso actualizado de matemáticas avanzadas", nullable=true),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-05-15T14:30:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Materia no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Materia no encontrada")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="materia_nombre",
 *                     type="array",
 *                     @OA\Items(type="string", example="El nombre de la materia es requerido")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al actualizar la materia: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Elimina una materia académica del sistema
 * 
 * @OA\Delete(
 *     path="/api/subjects/{id}",
 *     tags={"Materias"},
 *     summary="Eliminar materia académica",
 *     description="Elimina permanentemente una materia académica siempre que no tenga asignaciones activas",
 *     operationId="destroySubject",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la materia a eliminar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Materia eliminada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Materia eliminada con éxito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Materia no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Materia no encontrada")
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflicto - Asignaciones activas",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="No se puede eliminar la materia porque tiene asignaciones activas"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="Error al eliminar la materia: Mensaje de error específico"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

/**
 * Crea una nueva matrícula de estudiante
 * 
 * @OA\Post(
 *     path="/api/enrollments",
 *     tags={"Matrículas"},
 *     summary="Registrar nueva matrícula",
 *     description="Crea una nueva matrícula para un estudiante en un grupo específico, verificando disponibilidad de cupo y duplicados",
 *     operationId="storeEnrollment",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de la matrícula a crear",
 *         @OA\JsonContent(
 *             required={"estudiante_id", "grupo_id", "matricula_año"},
 *             @OA\Property(
 *                 property="estudiante_id", 
 *                 type="integer", 
 *                 example=1,
 *                 description="ID del estudiante a matricular"
 *             ),
 *             @OA\Property(
 *                 property="grupo_id", 
 *                 type="integer", 
 *                 example=1,
 *                 description="ID del grupo donde se matriculará al estudiante"
 *             ),
 *             @OA\Property(
 *                 property="matricula_año", 
 *                 type="integer", 
 *                 example=2023,
 *                 description="Año académico de la matrícula",
 *                 minimum=1900,
 *                 maximum=2025
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Matrícula creada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Matrícula creada con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="matricula_id", type="integer", example=1),
 *                 @OA\Property(property="estudiante_id", type="integer", example=1),
 *                 @OA\Property(property="grupo_id", type="integer", example=1),
 *                 @OA\Property(property="matricula_año", type="integer", example=2023),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-03-01T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Recurso no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Grupo no encontrado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflictos de matrícula",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="success", type="boolean", example=false),
 *                     @OA\Property(property="message", type="string", example="El estudiante ya está matriculado en este periodo académico (2023) en el grupo Grupo A")
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(property="success", type="boolean", example=false),
 *                     @OA\Property(property="message", type="string", example="El grupo Grupo A ya ha alcanzado su cupo máximo de estudiantes")
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="estudiante_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="El estudiante no existe")
 *                 ),
 *                 @OA\Property(
 *                     property="grupo_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="El grupo no existe")
 *                 ),
 *                 @OA\Property(
 *                     property="matricula_año",
 *                     type="array",
 *                     @OA\Items(type="string", example="El año de matrícula debe ser numérico")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al crear la matrícula: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Actualiza una matrícula existente
 * 
 * @OA\Put(
 *     path="/api/enrollments/{id}",
 *     tags={"Matrículas"},
 *     summary="Actualizar matrícula",
 *     description="Actualiza la información de una matrícula existente, verificando duplicados en el mismo año académico",
 *     operationId="updateEnrollment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la matrícula a actualizar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de la matrícula a actualizar",
 *         @OA\JsonContent(
 *             required={"grupo_id", "matricula_año"},
 *             @OA\Property(
 *                 property="grupo_id", 
 *                 type="integer", 
 *                 example=2,
 *                 description="Nuevo ID del grupo para la matrícula"
 *             ),
 *             @OA\Property(
 *                 property="matricula_año", 
 *                 type="integer", 
 *                 example=2024,
 *                 description="Año académico de la matrícula",
 *                 minimum=1900
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Matrícula actualizada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Matrícula actualizada con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="matricula_id", type="integer", example=1),
 *                 @OA\Property(property="estudiante_id", type="integer", example=1),
 *                 @OA\Property(property="grupo_id", type="integer", example=2),
 *                 @OA\Property(property="matricula_año", type="integer", example=2024),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-02-20T14:30:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Matrícula no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Matrícula no encontrada")
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflicto - Matrícula duplicada",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="El estudiante ya está matriculado en este grupo para el año 2024"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="grupo_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="El grupo no existe")
 *                 ),
 *                 @OA\Property(
 *                     property="matricula_año",
 *                     type="array",
 *                     @OA\Items(type="string", example="El año de matrícula debe ser numérico")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al actualizar la matrícula: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Elimina una matrícula existente
 * 
 * @OA\Delete(
 *     path="/api/enrollments/{id}",
 *     tags={"Matrículas"},
 *     summary="Eliminar matrícula",
 *     description="Elimina una matrícula existente siempre que no tenga dependencias asociadas (como calificaciones)",
 *     operationId="destroyEnrollment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la matrícula a eliminar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Matrícula eliminada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Matrícula eliminada con éxito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Matrícula no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Matrícula no encontrada")
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflicto - Dependencias existentes",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="No se puede eliminar la matrícula porque tiene notas asociadas"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="Error al eliminar la matrícula: Mensaje de error específico"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Actualiza una solicitud de matrícula y crea la matrícula correspondiente
 * 
 * @OA\Put(
 *     path="/api/enrollments-requests/{id}",
 *     tags={"Matrículas"},
 *     summary="Procesar solicitud de matrícula",
 *     description="Actualiza el estado de una solicitud de matrícula y crea la matrícula correspondiente, manejando tanto estudiantes nuevos como existentes",
 *     operationId="updateEnrollmentRequest",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la solicitud de matrícula a procesar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             minimum=1,
 *             example=1
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos para procesar la solicitud de matrícula",
 *         @OA\JsonContent(
 *             required={"grupo_id", "matricula_año", "es_nuevo"},
 *             @OA\Property(property="grupo_id", type="integer", example=1, description="ID del grupo asignado"),
 *             @OA\Property(property="matricula_año", type="integer", example=2023, description="Año académico de la matrícula"),
 *             @OA\Property(property="es_nuevo", type="boolean", example=true, description="Indica si es un estudiante nuevo"),
 *             @OA\Property(
 *                 property="estudiante_id", 
 *                 type="integer", 
 *                 example=1, 
 *                 description="ID del estudiante existente (solo cuando es_nuevo = false)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_nombre", 
 *                 type="string", 
 *                 example="Juan", 
 *                 description="Nombre del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_apellido", 
 *                 type="string", 
 *                 example="Pérez", 
 *                 description="Apellido del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_correo", 
 *                 type="string", 
 *                 format="email", 
 *                 example="juan@example.com", 
 *                 description="Correo del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_documento_tipo", 
 *                 type="string", 
 *                 example="DNI", 
 *                 description="Tipo de documento del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_documento", 
 *                 type="string", 
 *                 example="12345678", 
 *                 description="Documento del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_nacimiento", 
 *                 type="string", 
 *                 format="date", 
 *                 example="2010-05-15", 
 *                 description="Fecha de nacimiento del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_direccion", 
 *                 type="string", 
 *                 example="Calle 123", 
 *                 description="Dirección del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_telefono", 
 *                 type="string", 
 *                 example="+123456789", 
 *                 description="Teléfono del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="estudiante_contra", 
 *                 type="string", 
 *                 example="password123", 
 *                 description="Contraseña del estudiante (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_nombre", 
 *                 type="string", 
 *                 example="María", 
 *                 description="Nombre del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_apellido", 
 *                 type="string", 
 *                 example="Gómez", 
 *                 description="Apellido del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_correo", 
 *                 type="string", 
 *                 format="email", 
 *                 example="maria@example.com", 
 *                 description="Correo del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_documento_tipo", 
 *                 type="string", 
 *                 example="DNI", 
 *                 description="Tipo de documento del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_documento", 
 *                 type="string", 
 *                 example="87654321", 
 *                 description="Documento del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_nacimiento", 
 *                 type="string", 
 *                 format="date", 
 *                 example="1980-05-15", 
 *                 description="Fecha de nacimiento del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_direccion", 
 *                 type="string", 
 *                 example="Avenida 456", 
 *                 description="Dirección del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_telefono", 
 *                 type="string", 
 *                 example="+987654321", 
 *                 description="Teléfono del tutor (solo cuando es_nuevo = true)"
 *             ),
 *             @OA\Property(
 *                 property="tutor_contra", 
 *                 type="string", 
 *                 example="password456", 
 *                 description="Contraseña del tutor (solo cuando es_nuevo = true)"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Solicitud procesada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Solicitud de matrícula actualizada con éxito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Recurso no encontrado",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="success", type="boolean", example=false),
 *                     @OA\Property(property="message", type="string", example="Solicitud de matrícula no encontrada")
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(property="success", type="boolean", example=false),
 *                     @OA\Property(property="message", type="string", example="Estudiante no encontrado")
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(property="success", type="boolean", example=false),
 *                     @OA\Property(property="message", type="string", example="Grupo no encontrado")
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflictos detectados",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="success", type="boolean", example=false),
 *                     @OA\Property(property="message", type="string", example="El estudiante ya está matriculado en este año (2023)")
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(property="success", type="boolean", example=false),
 *                     @OA\Property(property="message", type="string", example="No hay cupos disponibles para este grupo")
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="grupo_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="El grupo no existe")
 *                 ),
 *                 @OA\Property(
 *                     property="tutor_correo",
 *                     type="array",
 *                     @OA\Items(type="string", example="El correo del tutor debe ser una dirección de correo electrónico válida")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al actualizar la solicitud de matrícula: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Crea un nuevo bloque horario
 * 
 * @OA\Post(
 *     path="/api/blocks",
 *     tags={"Horarios"},
 *     summary="Crear bloque horario",
 *     description="Crea un nuevo bloque horario para una institución, con validación de horarios",
 *     operationId="storeBlock",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos del bloque horario a crear",
 *         @OA\JsonContent(
 *             required={"bloque_dia", "bloque_inicio", "bloque_fin", "institucion_id"},
 *             @OA\Property(
 *                 property="bloque_dia", 
 *                 type="string", 
 *                 maxLength=255,
 *                 example="Lunes",
 *                 description="Día de la semana para el bloque"
 *             ),
 *             @OA\Property(
 *                 property="bloque_inicio", 
 *                 type="string", 
 *                 format="time",
 *                 example="08:00",
 *                 description="Hora de inicio del bloque en formato HH:mm"
 *             ),
 *             @OA\Property(
 *                 property="bloque_fin", 
 *                 type="string", 
 *                 format="time",
 *                 example="09:30",
 *                 description="Hora de fin del bloque en formato HH:mm (debe ser posterior a la hora de inicio)"
 *             ),
 *             @OA\Property(
 *                 property="institucion_id", 
 *                 type="integer", 
 *                 example=1,
 *                 description="ID de la institución a la que pertenece el bloque"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Bloque creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Bloque creado con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="bloque_id", type="integer", example=1),
 *                 @OA\Property(property="bloque_dia", type="string", example="Lunes"),
 *                 @OA\Property(property="bloque_inicio", type="string", example="08:00"),
 *                 @OA\Property(property="bloque_fin", type="string", example="09:30"),
 *                 @OA\Property(property="institucion_id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-03-01T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Solicitud incorrecta",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="La hora de fin debe ser posterior a la hora de inicio")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="bloque_dia",
 *                     type="array",
 *                     @OA\Items(type="string", example="El día del bloque no puede exceder los 255 caracteres")
 *                 ),
 *                 @OA\Property(
 *                     property="bloque_inicio",
 *                     type="array",
 *                     @OA\Items(type="string", example="La hora de inicio debe tener el formato HH:mm")
 *                 ),
 *                 @OA\Property(
 *                     property="institucion_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="La institución no existe")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al crear el bloque: Mensaje de error específico")
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */


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

/**
 * Actualizar un bloque horario
 * @OA\Put(
 *     path="/api/blocks/{id}",
 *     tags={"Horarios"},
 *     summary="Actualizar un bloque horario existente",
 *     description="Actualiza la información de un bloque horario específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del bloque horario",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos del bloque horario a actualizar",
 *         @OA\JsonContent(
 *             @OA\Property(property="bloque_dia", type="string", maxLength=255, example="Lunes", description="Día de la semana"),
 *             @OA\Property(property="bloque_inicio", type="string", format="time", example="08:00", description="Hora de inicio en formato HH:mm"),
 *             @OA\Property(property="bloque_fin", type="string", format="time", example="09:30", description="Hora de fin en formato HH:mm (debe ser posterior a la hora de inicio)")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Bloque actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Bloque actualizado con éxito"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="bloque_dia", type="string", example="Lunes"),
 *                 @OA\Property(property="bloque_inicio", type="string", example="08:00:00"),
 *                 @OA\Property(property="bloque_fin", type="string", example="09:30:00"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-01T00:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-01-02T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Bloque no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Bloque no encontrado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="bloque_dia", type="array",
 *                     @OA\Items(type="string", example="El día del bloque no puede exceder los 255 caracteres")
 *                 ),
 *                 @OA\Property(property="bloque_inicio", type="array",
 *                     @OA\Items(type="string", example="La hora de inicio debe tener el formato HH:mm:ss")
 *                 ),
 *                 @OA\Property(property="bloque_fin", type="array",
 *                     @OA\Items(type="string", example="La hora de fin debe ser posterior a la hora de inicio")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Error al actualizar el bloque: Mensaje de error específico")
 *         )
 *     )
 * )
 */

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

    /**
 * Crear un nuevo horario
 * @OA\Post(
 *     path="/api/schedules",
 *     tags={"Horarios"},
 *     summary="Crear un nuevo horario",
 *     description="Crea una nueva asignación de horario para un docente",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos para crear el horario",
 *         @OA\JsonContent(
 *             required={"asignacion_id", "bloque_id"},
 *             @OA\Property(
 *                 property="asignacion_id",
 *                 type="integer",
 *                 example=1,
 *                 description="ID de la asignación docente"
 *             ),
 *             @OA\Property(
 *                 property="bloque_id",
 *                 type="integer",
 *                 example=1,
 *                 description="ID del bloque horario"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Horario creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Horario creado con éxito"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="horario_id", type="integer", example=1),
 *                 @OA\Property(property="asignacion_id", type="integer", example=1),
 *                 @OA\Property(property="bloque_id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-01T00:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-01-01T00:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Recurso no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Asignación no encontrada",
 *                 description="Puede indicar que no se encontró la asignación o el bloque"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflicto - Horario ya existe",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="El docente ya tiene una clase programada en este horario."
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="asignacion_id", type="array",
 *                     @OA\Items(type="string", example="La asignación no existe")
 *                 ),
 *                 @OA\Property(property="bloque_id", type="array",
 *                     @OA\Items(type="string", example="El bloque no existe")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al crear el horario: Mensaje de error específico"
 *             )
 *         )
 *     )
 * )
 */

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

    /**
 * Update an existing schedule
 * @OA\Put(
 *     path="/api/schedules/{id}",
 *     tags={"Horarios"},
 *     summary="Update a schedule",
 *     description="Updates an existing schedule with validation to prevent teacher double-booking",
 *     operationId="updateSchedule",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the schedule to update",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             example=1
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Schedule data to update",
 *         @OA\JsonContent(
 *             required={},
 *             @OA\Property(
 *                 property="asignacion_id",
 *                 type="integer",
 *                 example=5,
 *                 description="Assignment ID (optional)"
 *             ),
 *             @OA\Property(
 *                 property="horario_dia",
 *                 type="string",
 *                 format="date",
 *                 example="2023-12-15",
 *                 description="Schedule date (optional)"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Schedule updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Horario actualizado con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 ref="#/components/schemas/Schedule"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Resource not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 oneOf={
 *                     @OA\Schema(type="string", example="Horario no encontrado"),
 *                     @OA\Schema(type="string", example="Asignación no encontrada")
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Conflict - Teacher already has a class scheduled",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="El docente ya tiene una clase programada en este horario."
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="asignacion_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="The selected asignacion_id is invalid.")
 *                 ),
 *                 @OA\Property(
 *                     property="horario_dia",
 *                     type="array",
 *                     @OA\Items(type="string", example="The horario_dia must be a valid date.")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al actualizar el horario: [specific error message]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="Schedule",
 *     type="object",
 *     @OA\Property(property="horario_id", type="integer", example=1),
 *     @OA\Property(property="asignacion_id", type="integer", example=5),
 *     @OA\Property(property="bloque_id", type="integer", example=3),
 *     @OA\Property(
 *         property="horario_dia",
 *         type="string",
 *         format="date",
 *         example="2023-12-15"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2023-01-01T00:00:00Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2023-12-15T08:30:00Z"
 *     )
 * )
 */

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

    /**
 * Delete a schedule
 * @OA\Delete(
 *     path="/api/schedules/{id}",
 *     tags={"Horarios"},
 *     summary="Delete a schedule",
 *     description="Deletes a specific schedule by its ID",
 *     operationId="deleteSchedule",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the schedule to delete",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Schedule deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="Horario eliminado con éxito"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Schedule not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Horario no encontrado"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al eliminar el horario: [specific error message]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Create a new observation
 * @OA\Post(
 *     path="/api/observations",
 *     tags={"Observaciones"},
 *     summary="Create a new observation",
 *     description="Creates a new observation record for a student enrollment",
 *     operationId="storeObservation",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Observation data",
 *         @OA\JsonContent(
 *             required={"matricula_id", "observacion_tipo", "observacion_descripcion", "observacion_fecha"},
 *             @OA\Property(
 *                 property="matricula_id",
 *                 type="integer",
 *                 example=123,
 *                 description="Enrollment ID"
 *             ),
 *             @OA\Property(
 *                 property="observacion_tipo",
 *                 type="string",
 *                 example="Comportamiento",
 *                 description="Type of observation"
 *             ),
 *             @OA\Property(
 *                 property="observacion_descripcion",
 *                 type="string",
 *                 example="El estudiante mostró comportamiento disruptivo en clase",
 *                 description="Observation details"
 *             ),
 *             @OA\Property(
 *                 property="observacion_fecha",
 *                 type="string",
 *                 format="date",
 *                 example="2023-05-15",
 *                 description="Date when observation was made"
 *             ),
 *             @OA\Property(
 *                 property="institucion_id",
 *                 type="integer",
 *                 example=1,
 *                 description="Institution ID (if required)"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Observation created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Observación creada con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="observacion_id", type="integer", example=1),
 *                 @OA\Property(property="matricula_id", type="integer", example=123),
 *                 @OA\Property(property="observacion_tipo", type="string", example="Comportamiento"),
 *                 @OA\Property(property="observacion_descripcion", type="string", example="El estudiante mostró comportamiento disruptivo en clase"),
 *                 @OA\Property(property="observacion_fecha", type="string", format="date", example="2023-05-15"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-05-15T10:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-05-15T10:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="matricula_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="La matrícula no existe")
 *                 ),
 *                 @OA\Property(
 *                     property="observacion_tipo",
 *                     type="array",
 *                     @OA\Items(type="string", example="El tipo de observación es requerido")
 *                 ),
 *                 @OA\Property(
 *                     property="observacion_descripcion",
 *                     type="array",
 *                     @OA\Items(type="string", example="La descripción de la observación es requerida")
 *                 ),
 *                 @OA\Property(
 *                     property="observacion_fecha",
 *                     type="array",
 *                     @OA\Items(type="string", example="La fecha de la observación debe ser una fecha válida")
 *                 ),
 *                 @OA\Property(
 *                     property="institucion_id",
 *                     type="array",
 *                     @OA\Items(type="string", example="La institución no existe")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al crear la observación: [specific error message]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Update an existing observation
 * @OA\Put(
 *     path="/api/observations/{id}",
 *     tags={"Observaciones"},
 *     summary="Update an observation",
 *     description="Updates an existing observation record",
 *     operationId="updateObservation",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the observation to update",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *             example=1
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Observation data to update",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="observacion_tipo",
 *                 type="string",
 *                 example="Comportamiento",
 *                 description="Type of observation (optional)"
 *             ),
 *             @OA\Property(
 *                 property="observacion_descripcion",
 *                 type="string",
 *                 example="El estudiante mostró mejoría en su comportamiento",
 *                 description="Observation details (optional)"
 *             ),
 *             @OA\Property(
 *                 property="observacion_fecha",
 *                 type="string",
 *                 format="date",
 *                 example="2023-06-20",
 *                 description="Date of observation (optional)"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Observation updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Observación actualizada con éxito"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="observacion_id", type="integer", example=1),
 *                 @OA\Property(property="matricula_id", type="integer", example=123),
 *                 @OA\Property(property="observacion_tipo", type="string", example="Comportamiento"),
 *                 @OA\Property(property="observacion_descripcion", type="string", example="El estudiante mostró mejoría en su comportamiento"),
 *                 @OA\Property(property="observacion_fecha", type="string", format="date", example="2023-06-20"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-06-20T14:30:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Observation not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Observación no encontrada")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="observacion_tipo",
 *                     type="array",
 *                     @OA\Items(type="string", example="El tipo de observación debe ser una cadena de caracteres")
 *                 ),
 *                 @OA\Property(
 *                     property="observacion_descripcion",
 *                     type="array",
 *                     @OA\Items(type="string", example="La descripción de la observación es requerida")
 *                 ),
 *                 @OA\Property(
 *                     property="observacion_fecha",
 *                     type="array",
 *                     @OA\Items(type="string", example="La fecha de la observación debe ser una fecha válida")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *                 example="Error al actualizar la observación: [specific error message]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"api_key": {}}
 *     }
 * )
 */

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

    /**
 * Eliminar una observación
 * @OA\Delete(
 *     path="/api/observations/{id}",
 *     tags={"Observaciones"},
 *     summary="Eliminar una observación",
 *     description="Elimina una observación específica del sistema",
 *     operationId="destroyObservation",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la observación a eliminar",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Observación eliminada con éxito",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Observación eliminada con éxito"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Observación no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Observación no encontrada"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al eliminar la observación: [mensaje de error]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */

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

    /**
 * Registrar o actualizar asistencias
 * @OA\Post(
 *     path="/api/attendances",
 *     tags={"Asistencias"},
 *     summary="Registrar o actualizar asistencias",
 *     description="Registra o actualiza múltiples asistencias para un grupo en una fecha específica",
 *     operationId="storeAttendance",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos para registrar asistencias",
 *         @OA\JsonContent(
 *             required={"asignacion_id", "asistencia_fecha", "matriculas", "asistencias_estados", "justificaciones"},
 *             @OA\Property(
 *                 property="asignacion_id",
 *                 type="string",
 *                 format="uuid",
 *                 description="ID de la asignación (grupo)",
 *                 example="550e8400-e29b-41d4-a716-446655440000"
 *             ),
 *             @OA\Property(
 *                 property="asistencia_fecha",
 *                 type="string",
 *                 format="date",
 *                 description="Fecha de la asistencia (YYYY-MM-DD)",
 *                 example="2023-05-15"
 *             ),
 *             @OA\Property(
 *                 property="matriculas",
 *                 type="array",
 *                 description="Array de IDs de matrículas",
 *                 @OA\Items(
 *                     type="string",
 *                     format="uuid",
 *                     example="550e8400-e29b-41d4-a716-446655440001"
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="asistencias_estados",
 *                 type="array",
 *                 description="Estados de asistencia correspondientes (presente, ausente, etc.)",
 *                 @OA\Items(
 *                     type="string",
 *                     example="presente"
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="justificaciones",
 *                 type="array",
 *                 description="Justificaciones para ausencias (opcional)",
 *                 @OA\Items(
 *                     type="string",
 *                     example="Enfermedad comprobada"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Asistencias registradas/actualizadas exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Asistencia creada con éxito"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en los datos proporcionados",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="El número de asistencias no coincide con el número de matrículas o no se proporcionaron justificaciones"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Los datos proporcionados no son válidos"
 *             ),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="asignacion_id",
 *                     type="array",
 *                     @OA\Items(
 *                         type="string",
 *                         example="El campo asignacion_id es obligatorio"
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al crear la asistencia: [mensaje de error]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */

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

    /**
 * Crear o actualizar notas académicas
 * @OA\Post(
 *     path="/api/grades",
 *     tags={"Calificaciones"},
 *     summary="Registrar o actualizar notas",
 *     description="Crea o actualiza múltiples calificaciones para estudiantes en una asignación específica",
 *     operationId="storeGrade",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos para registrar las notas",
 *         @OA\JsonContent(
 *             required={"asignacion_id", "notas", "matriculas", "periodos"},
 *             @OA\Property(
 *                 property="asignacion_id",
 *                 type="string",
 *                 format="uuid",
 *                 description="ID de la asignación (grupo-materia)",
 *                 example="550e8400-e29b-41d4-a716-446655440000"
 *             ),
 *             @OA\Property(
 *                 property="notas",
 *                 type="array",
 *                 description="Valores numéricos de las notas",
 *                 @OA\Items(
 *                     type="number",
 *                     format="float",
 *                     example=4.5
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="matriculas",
 *                 type="array",
 *                 description="IDs de matrículas de los estudiantes",
 *                 @OA\Items(
 *                     type="string",
 *                     format="uuid",
 *                     example="550e8400-e29b-41d4-a716-446655440001"
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="periodos",
 *                 type="array",
 *                 description="IDs de periodos académicos",
 *                 @OA\Items(
 *                     type="string",
 *                     format="uuid",
 *                     example="550e8400-e29b-41d4-a716-446655440002"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Notas creadas/actualizadas exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Notas creadas con éxito"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en los datos de entrada",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     @OA\Property(
 *                         property="success",
 *                         type="boolean",
 *                         example=false
 *                     ),
 *                     @OA\Property(
 *                         property="message",
 *                         type="string",
 *                         example="El número de notas no coincide con el número de matrículas o periodos"
 *                     )
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                         property="success",
 *                         type="boolean",
 *                         example=false
 *                     ),
 *                     @OA\Property(
 *                         property="message",
 *                         type="string",
 *                         example="La nota debe estar entre 0.0 y 5.0"
 *                     )
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Los datos proporcionados no son válidos"
 *             ),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="asignacion_id",
 *                     type="array",
 *                     @OA\Items(
 *                         type="string",
 *                         example="El campo asignacion_id es obligatorio"
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al crear las notas: [mensaje de error]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */

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

    /**
 * Registrar un nuevo pago
 * @OA\Post(
 *     path="/api/payments",
 *     tags={"Pagos"},
 *     summary="Crear un nuevo pago",
 *     description="Registra un nuevo pago en el sistema",
 *     operationId="storePayment",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos para registrar el pago",
 *         @OA\JsonContent(
 *             required={"matricula_id", "concepto_id", "pago_fecha", "pago_valor", "pago_estado"},
 *             @OA\Property(
 *                 property="matricula_id",
 *                 type="string",
 *                 format="uuid",
 *                 description="ID de la matrícula asociada",
 *                 example="550e8400-e29b-41d4-a716-446655440000"
 *             ),
 *             @OA\Property(
 *                 property="concepto_id",
 *                 type="string",
 *                 format="uuid",
 *                 description="ID del concepto de pago",
 *                 example="550e8400-e29b-41d4-a716-446655440001"
 *             ),
 *             @OA\Property(
 *                 property="pago_fecha",
 *                 type="string",
 *                 format="date",
 *                 description="Fecha del pago (YYYY-MM-DD)",
 *                 example="2023-05-15"
 *             ),
 *             @OA\Property(
 *                 property="pago_valor",
 *                 type="number",
 *                 format="float",
 *                 description="Valor del pago",
 *                 example=150.75
 *             ),
 *             @OA\Property(
 *                 property="pago_estado",
 *                 type="string",
 *                 description="Estado del pago (ej. pagado, pendiente, anulado)",
 *                 example="pagado"
 *             ),
 *             @OA\Property(
 *                 property="pago_comprobante",
 *                 type="string",
 *                 description="Número de comprobante (opcional)",
 *                 example="PAY-12345",
 *                 nullable=true
 *             ),
 *             @OA\Property(
 *                 property="pago_observaciones",
 *                 type="string",
 *                 description="Observaciones adicionales (opcional)",
 *                 example="Pago realizado por transferencia bancaria",
 *                 nullable=true
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pago creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Pago creado con éxito"
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(
 *                     property="pago_id",
 *                     type="string",
 *                     format="uuid",
 *                     example="550e8400-e29b-41d4-a716-446655440002"
 *                 ),
 *                 @OA\Property(
 *                     property="matricula_id",
 *                     type="string",
 *                     example="550e8400-e29b-41d4-a716-446655440000"
 *                 ),
 *                 @OA\Property(
 *                     property="concepto_id",
 *                     type="string",
 *                     example="550e8400-e29b-41d4-a716-446655440001"
 *                 ),
 *                 @OA\Property(
 *                     property="pago_fecha",
 *                     type="string",
 *                     format="date",
 *                     example="2023-05-15"
 *                 ),
 *                 @OA\Property(
 *                     property="pago_valor",
 *                     type="number",
 *                     example=150.75
 *                 ),
 *                 @OA\Property(
 *                     property="pago_estado",
 *                     type="string",
 *                     example="pagado"
 *                 ),
 *                 @OA\Property(
 *                     property="created_at",
 *                     type="string",
 *                     format="date-time",
 *                     example="2023-05-15T14:30:00Z"
 *                 ),
 *                 @OA\Property(
 *                     property="updated_at",
 *                     type="string",
 *                     format="date-time",
 *                     example="2023-05-15T14:30:00Z"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="El pago ya existe",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="El pago ya existe"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Los datos proporcionados no son válidos"
 *             ),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="matricula_id",
 *                     type="array",
 *                     @OA\Items(
 *                         type="string",
 *                         example="La matrícula no existe"
 *                     )
 *                 ),
 *                 @OA\Property(
 *                     property="pago_valor",
 *                     type="array",
 *                     @OA\Items(
 *                         type="string",
 *                         example="El valor de pago debe ser un número"
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Error al crear el pago: [mensaje de error]"
 *             )
 *         )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */

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
