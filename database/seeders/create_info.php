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
            ['rol_id' => 2, 'rol_nombre' => 'Administrativo'],      // Gestión de cada colegio.
            ['rol_id' => 3, 'rol_nombre' => 'Docente'],             // Gestión académica.
            ['rol_id' => 4, 'rol_nombre' => 'Estudiante'],          // Consulta propia.
            ['rol_id' => 5, 'rol_nombre' => 'Padre/Madre/Tutor'],   // Consulta información de hijos.
        ]);

        DB::table('permisos')->insert([
            // Configuración institucional
            ['permiso_id' => 1, 'permiso_nombre' => 'gestionar_institucion'],

            // Gestión de usuarios
            ['permiso_id' => 2, 'permiso_nombre' => 'gestionar_administrativos'],
            ['permiso_id' => 3, 'permiso_nombre' => 'gestionar_docentes'],
            ['permiso_id' => 4, 'permiso_nombre' => 'gestionar_estudiantes'],

            // Gestión académica
            ['permiso_id' => 5, 'permiso_nombre' => 'gestionar_cursos'],
            ['permiso_id' => 6, 'permiso_nombre' => 'gestionar_materias'],
            ['permiso_id' => 7, 'permiso_nombre' => 'gestionar_horarios'],
            ['permiso_id' => 8, 'permiso_nombre' => 'gestionar_periodos'],

            // Inasistencias
            ['permiso_id' => 9, 'permiso_nombre' => 'gestionar_inasistencias'],

            // Observaciones
            ['permiso_id' => 10, 'permiso_nombre' => 'gestionar_observaciones'],

            // Pagos y Finanzas
            ['permiso_id' => 11, 'permiso_nombre' => 'gestionar_pagos'],
        ]);

        DB::table('niveles')->insert([
            ['nivel_id' => 1, 'nivel_nombre' => 'Preescolar'],
            ['nivel_id' => 2, 'nivel_nombre' => 'Primaria'],
            ['nivel_id' => 3, 'nivel_nombre' => 'Secundaria'],
            ['nivel_id' => 4, 'nivel_nombre' => 'bachillerato'],
        ]);

        DB::table('grados')->insert([
            ['grado_id' => 1, 'grado_nombre' => 'Preescolar', 'nivel_id' => 1],
            ['grado_id' => 2, 'grado_nombre' => 'primero', 'nivel_id' => 2],
            ['grado_id' => 3, 'grado_nombre' => 'segundo', 'nivel_id' => 2],
            ['grado_id' => 4, 'grado_nombre' => 'tercero', 'nivel_id' => 2],
            ['grado_id' => 5, 'grado_nombre' => 'cuarto', 'nivel_id' => 2],
            ['grado_id' => 6, 'grado_nombre' => 'quinto', 'nivel_id' => 2],
            ['grado_id' => 7, 'grado_nombre' => 'sexto', 'nivel_id' => 3],
            ['grado_id' => 8, 'grado_nombre' => 'séptimo', 'nivel_id' => 3],
            ['grado_id' => 9, 'grado_nombre' => 'octavo', 'nivel_id' => 3],
            ['grado_id' => 10, 'grado_nombre' => 'noveno', 'nivel_id' => 3],
            ['grado_id' => 11, 'grado_nombre' => 'décimo', 'nivel_id' => 4],
            ['grado_id' => 12, 'grado_nombre' => 'undécimo', 'nivel_id' => 4],
        ]);

        DB::table('instituciones')->insert([
            [
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'institucion_nombre' => 'Instituto Liceo Moderno Betania de Bogotá',
                'institucion_telefono' => 3103436767,
                'institucion_correo' => 'Licbetania@yahoo.com',
                'institucion_nit' => '41723418-7',
                'institucion_direccion' => 'Kr 87 51 B 36 Sur, Bogotá, Bogotá DC.',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'institucion_id' => '205117f9-fa69-4003-9446-b747e6655ec9',
                'institucion_nombre' => 'Colegio Angela Restrepo Moreno IED',
                'institucion_telefono' => 3007070248,
                'institucion_correo' => 'cadel19@educacionbogota.edu.co',
                'institucion_nit' => '899999061-9',
                'institucion_direccion' => ' CL 69 SUR # 71 G - 12 ',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'institucion_id' => 'c07a0727-853b-4120-a568-b6901f371256',
                'institucion_nombre' => 'Colegio Centro Integral José María Córdoba (IED)',
                'institucion_telefono' => 7692587,
                'institucion_correo' => 'coldijosemariacord6@educacionbogota.edu.co',
                'institucion_nit' => '800132956-4',
                'institucion_direccion' => 'Calle 48 C Sur Nº 24-14',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'institucion_id' => '3b97a2ee-f1d1-4529-9587-35b207da718d',
                'institucion_nombre' => 'Colegio INEM Santiago Pérez (IED)',
                'institucion_telefono' => 12799359,
                'institucion_correo' => 'inemsantiagoperez6@educacionbogota.edu.co',
                'institucion_nit' => '830017442-8',
                'institucion_direccion' => 'Kr 24 #49-86 Sur, Tunjuelito, Bogotá',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'institucion_id' => '01a3265b-de79-4411-98dc-ef0ff1a97afd',
                'institucion_nombre' => 'Colegio María Mercedes Carranza (IED)',
                'institucion_telefono' => 7750033,
                'institucion_correo' => 'colmarmercedcarranza@educacionbogota.edu.co',
                'institucion_nit' => '830130422-3',
                'institucion_direccion' => 'El Perdomo, Tv. 70g #65 Sur-2, Bogotá',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'institucion_id' => '988fa2bc-c42e-4fd6-beb7-2bb2e368f671',
                'institucion_nombre' => 'Colegio Ciudadela Educativa de Bosa (IED)',
                'institucion_telefono' => 4288697,
                'institucion_correo' => 'colciudadelabosa@educacionbogota.edu.co',
                'institucion_nit' => '900219678-1',
                'institucion_direccion' => 'Cl. 52 Sur #97C - 35, Bogotá',
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);

        DB::table('periodos_academicos')->insert([
            [
                'periodo_academico_id' => '01971778-0bd8-73ea-8a02-3f88f0dee1c1',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2025-I',
                'periodo_academico_año' => 2025,
                'periodo_academico_inicio' => '2025-01-06',
                'periodo_academico_fin' => '2025-03-28',
            ],
            [
                'periodo_academico_id' => '01971778-0c07-76cf-a465-ed1fe44f04eb',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2025-II',
                'periodo_academico_año' => 2025,
                'periodo_academico_inicio' => '2025-04-07',
                'periodo_academico_fin' => '2025-06-27',
            ],
            [
                'periodo_academico_id' => '01971778-0c0f-74db-ba8f-360c46f4b9f5',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2025-III',
                'periodo_academico_año' => 2025,
                'periodo_academico_inicio' => '2025-07-14',
                'periodo_academico_fin' => '2025-10-03',
            ],
            [
                'periodo_academico_id' => '01971778-0c18-7515-a91e-8dbbb53f3dcb',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2025-IV',
                'periodo_academico_año' => 2025,
                'periodo_academico_inicio' => '2025-10-13',
                'periodo_academico_fin' => '2025-12-19',
            ],
            [
                'periodo_academico_id' => '0197177c-0232-7788-8f7f-839a61991958',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2026-I',
                'periodo_academico_año' => 2026,
                'periodo_academico_inicio' => '2026-01-05',
                'periodo_academico_fin' => '2026-03-27',
            ],
            [
                'periodo_academico_id' => '0197177c-0231-720f-ba01-b758b68052c2',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2026-II',
                'periodo_academico_año' => 2026,
                'periodo_academico_inicio' => '2026-04-06',
                'periodo_academico_fin' => '2026-06-26',
            ],
            [
                'periodo_academico_id' => '0197177c-022b-71ed-a538-3fef329797e1',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2026-III',
                'periodo_academico_año' => 2026,
                'periodo_academico_inicio' => '2026-07-13',
                'periodo_academico_fin' => '2026-10-02',
            ],
            [
                'periodo_academico_id' => '0197177c-01f7-7149-af9c-b105e08debf5',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'periodo_academico_nombre' => '2026-IV',
                'periodo_academico_año' => 2026,
                'periodo_academico_inicio' => '2026-10-13',
                'periodo_academico_fin' => '2026-12-18',
            ]
        ]);
    }
}
