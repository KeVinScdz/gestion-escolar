<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;

use App\Models\Administrativo;
use App\Models\AdministrativoPermiso;
use App\Models\Asignacion;
use App\Models\Bloque;
use App\Models\ConceptoPago;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Grado;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Asistencia;
use App\Models\Institucion;
use App\Models\Materia;
use App\Models\Matricula;
use App\Models\Nivel;
use App\Models\Nota;
use App\Models\Observacion;
use App\Models\Pago;
use App\Models\PeriodoAcademico;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Tutor;
use App\Models\Usuario;

class BackupController
{
    public function exportData(Request $request)
    {
        $data = [
            'roles' => Rol::all()->toArray(),
            'permisos' => Permiso::all()->toArray(),
            'administrativos_permisos' => AdministrativoPermiso::all()->toArray(),
            'usuarios' => Usuario::all()->toArray(),
            'estudiantes' => Estudiante::all()->toArray(),
            'tutores' => Tutor::all()->toArray(),
            'docentes' => Docente::all()->toArray(),
            'administrativos' => Administrativo::all()->toArray(),
            'instituciones' => Institucion::all()->toArray(),
            'periodos_academicos' => PeriodoAcademico::all()->toArray(),
            'niveles' => Nivel::all()->toArray(),
            'grados' => Grado::all()->toArray(),
            'grupos' => Grupo::all()->toArray(),
            'materias' => Materia::all()->toArray(),
            'asignaciones' => Asignacion::all()->toArray(),
            'bloques' => Bloque::all()->toArray(),
            'horarios' => Horario::all()->toArray(),
            'notas' => Nota::all()->toArray(),
            'matriculas' => Matricula::all()->toArray(),
            'asistencias' => Asistencia::all()->toArray(),
            'conceptos_pago' => ConceptoPago::all()->toArray(),
            'pagos' => Pago::all()->toArray(),
            'observaciones' => Observacion::all()->toArray(),
        ];

        return response()->json($data, 200);
    }
}