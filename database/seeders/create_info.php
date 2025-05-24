<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class create_info extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['rol_id' => 1, 'rol_nombre' => 'Administrador'],       // Acceso completo a todo el sistema.
            ['rol_id' => 2, 'rol_nombre' => 'Docente'],             // Gestión académica.
            ['rol_id' => 3, 'rol_nombre' => 'Estudiante'],          // Consulta propia.
            ['rol_id' => 4, 'rol_nombre' => 'Administrativo'],      // Gestión administrativa y financiera.
            ['rol_id' => 5, 'rol_nombre' => 'Padre/Madre/Tutor'],   // Consulta información de hijos.
        ]);

        DB::table('permisos')->insert([
            // Gestión de usuarios
            ['permiso_id' => 1, 'permiso_nombre' => 'ver_usuarios'],
            ['permiso_id' => 2, 'permiso_nombre' => 'crear_usuarios'],
            ['permiso_id' => 3, 'permiso_nombre' => 'editar_usuarios'],
            ['permiso_id' => 4, 'permiso_nombre' => 'eliminar_usuarios'],

            // Gestión de matrículas
            ['permiso_id' => 5, 'permiso_nombre' => 'ver_matriculas'],
            ['permiso_id' => 6, 'permiso_nombre' => 'crear_matriculas'],
            ['permiso_id' => 7, 'permiso_nombre' => 'editar_matriculas'],
            ['permiso_id' => 8, 'permiso_nombre' => 'eliminar_matriculas'],

            // Gestión académica
            ['permiso_id' => 9, 'permiso_nombre' => 'gestionar_notas'],
            ['permiso_id' => 10, 'permiso_nombre' => 'gestionar_asignaciones'],
            ['permiso_id' => 11, 'permiso_nombre' => 'gestionar_inasistencias'],
            ['permiso_id' => 12, 'permiso_nombre' => 'gestionar_observaciones'],

            // Gestión financiera y roles
            ['permiso_id' => 13, 'permiso_nombre' => 'gestionar_pagos'],
            ['permiso_id' => 14, 'permiso_nombre' => 'gestionar_roles'],
        ]);

        DB::table('roles_permisos')->insert([
            // Administrador (todos los permisos)
            ['rol_id' => 1, 'permiso_id' => 1],
            ['rol_id' => 1, 'permiso_id' => 2],
            ['rol_id' => 1, 'permiso_id' => 3],
            ['rol_id' => 1, 'permiso_id' => 4],
            ['rol_id' => 1, 'permiso_id' => 5],
            ['rol_id' => 1, 'permiso_id' => 6],
            ['rol_id' => 1, 'permiso_id' => 7],
            ['rol_id' => 1, 'permiso_id' => 8],
            ['rol_id' => 1, 'permiso_id' => 9],
            ['rol_id' => 1, 'permiso_id' => 10],
            ['rol_id' => 1, 'permiso_id' => 11],
            ['rol_id' => 1, 'permiso_id' => 12],
            ['rol_id' => 1, 'permiso_id' => 13],
            ['rol_id' => 1, 'permiso_id' => 14],

            // Docente (gestión académica)
            ['rol_id' => 2, 'permiso_id' => 5],   // ver_matriculas (sus estudiantes)
            ['rol_id' => 2, 'permiso_id' => 9],   // gestionar_notas
            ['rol_id' => 2, 'permiso_id' => 10],  // gestionar_asignaciones
            ['rol_id' => 2, 'permiso_id' => 11],  // gestionar_inasistencias
            ['rol_id' => 2, 'permiso_id' => 12],  // gestionar_observaciones

            // Estudiante (solo consulta propia)
            ['rol_id' => 3, 'permiso_id' => 5],   // ver_matriculas (propias)
            ['rol_id' => 3, 'permiso_id' => 13],  // gestionar_pagos (propios)

            // Administrativo (gestión académica y financiera)
            ['rol_id' => 4, 'permiso_id' => 5],   // ver_matriculas
            ['rol_id' => 4, 'permiso_id' => 6],   // crear_matriculas
            ['rol_id' => 4, 'permiso_id' => 7],   // editar_matriculas
            ['rol_id' => 4, 'permiso_id' => 8],   // eliminar_matriculas
            ['rol_id' => 4, 'permiso_id' => 13],  // gestionar_pagos
            ['rol_id' => 4, 'permiso_id' => 14],  // gestionar_roles

            // Padre/Madre/Tutor (consulta limitada)
            ['rol_id' => 5, 'permiso_id' => 5],   // ver_matriculas (hijos)
            ['rol_id' => 5, 'permiso_id' => 12],  // gestionar_observaciones (hijos)
            ['rol_id' => 5, 'permiso_id' => 13],  // gestionar_pagos (hijos)
        ]);
    }
}
