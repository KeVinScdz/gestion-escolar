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

        DB::table('grupos')->insert([
            // Transición (grado_id = 1)
            [
                'grupo_id' => '019717a9-ddcb-756b-bf6b-280a404e032d',
                'grado_id' => 1,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Transición A',
                'grupo_cupo' => 15,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-ddce-724e-8178-2d988b69f55f',
                'grado_id' => 1,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Transición B',
                'grupo_cupo' => 15,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-ddcf-7545-905d-3647eb0cf474',
                'grado_id' => 1,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Transición C',
                'grupo_cupo' => 15,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-ddef-70a6-9dba-bacbef8ba380',
                'grado_id' => 1,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Transición D',
                'grupo_cupo' => 15,
                'grupo_año' => 2025
            ],

            // Grados 1° a 11°, con 2 grupos A y B cada uno
            [
                'grupo_id' => '019717a9-ddf6-7287-bba3-ce93e987ac2b',
                'grado_id' => 2,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Primero A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-ddf7-71ab-adc4-5a6b45175221',
                'grado_id' => 2,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Primero B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-ddfe-764e-b7fb-a1a6ff1634df',
                'grado_id' => 3,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Segundo A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-ddff-7690-8b31-9c35feff43ff',
                'grado_id' => 3,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Segundo B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de00-747f-9c24-90348012ca57',
                'grado_id' => 4,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Tercero A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de02-70d9-bdfa-093d67ce628f',
                'grado_id' => 4,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Tercero B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de0a-777a-8869-9a1c89204e36',
                'grado_id' => 5,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Cuarto A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de0b-742a-b77a-f800852d10f6',
                'grado_id' => 5,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Cuarto B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de12-76dc-91a5-f26437d99993',
                'grado_id' => 6,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Quinto A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de13-76ed-8c6b-1d4b4436b04d',
                'grado_id' => 6,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Quinto B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de14-7259-a116-51d70afa72d2',
                'grado_id' => 7,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Sexto A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de16-7076-9d69-5680104206cf',
                'grado_id' => 7,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Sexto B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de1d-753d-840f-c43f8c36f45d',
                'grado_id' => 8,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Séptimo A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de1e-73dc-ad93-66084c7385c6',
                'grado_id' => 8,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Séptimo B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de20-7259-a382-476bddb1d8d7',
                'grado_id' => 9,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Octavo A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de23-729b-be0d-11af41c5393c',
                'grado_id' => 9,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Octavo B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de24-70cf-8543-d280e125083b',
                'grado_id' => 10,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Noveno A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de25-771b-b23a-01097ea71205',
                'grado_id' => 10,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Noveno B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de26-722c-a8bb-11a9659618ba',
                'grado_id' => 11,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Décimo A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de28-7289-9c21-53c11de7a4b8',
                'grado_id' => 11,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Décimo B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],

            [
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
                'grado_id' => 12,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Undécimo A',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
            [
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
                'grado_id' => 12,
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'grupo_nombre' => 'Undécimo B',
                'grupo_cupo' => 30,
                'grupo_año' => 2025
            ],
        ]);

        DB::table('materias')->insert([
            [
                'materia_id' => '019717d5-0046-772b-b23f-e9c9b2336a63',
                'materia_nombre' => 'Matemáticas',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-00b3-7770-b526-9279e5056c62',
                'materia_nombre' => 'Álgebra',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-00c9-716c-bdb8-4bb32d70217e',
                'materia_nombre' => 'Geometría',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-00cf-7320-a363-d3a254fdf7e1',
                'materia_nombre' => 'Trigonometría',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-00dd-773d-b09a-b3c1df947445',
                'materia_nombre' => 'Cálculo',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-00df-752a-91a0-1c251cc69836',
                'materia_nombre' => 'Español y Literatura',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-00e3-7452-9163-e6c495bacb5c',
                'materia_nombre' => 'Inglés',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-00f5-703b-8c23-e0f2bdaab74a',
                'materia_nombre' => 'Física',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0101-745a-aeff-a5bf6dde15e4',
                'materia_nombre' => 'Química',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0110-71ca-bf4c-0d3141f41e07',
                'materia_nombre' => 'Biología',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0112-7371-b580-863a91da32c6',
                'materia_nombre' => 'Ciencias Naturales',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0114-7069-898b-47696dd7a6e8',
                'materia_nombre' => 'Ciencias Sociales',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-012f-726c-a168-3cc4e5063aca',
                'materia_nombre' => 'Historia',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0132-7279-9860-266f43ea7c13',
                'materia_nombre' => 'Geografía',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0153-73cc-ac95-eb6a089210c0',
                'materia_nombre' => 'Filosofía',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0167-7158-adb6-19f8e70498a9',
                'materia_nombre' => 'Ética y Valores',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0169-708b-9fa1-484cd44f3e81',
                'materia_nombre' => 'Religión',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-016b-764f-9722-d2b4df7494aa',
                'materia_nombre' => 'Educación Física',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-016d-7649-a82d-7c291118fde3',
                'materia_nombre' => 'Educación Artística',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-0181-74b8-9c0f-ec8b1f203860',
                'materia_nombre' => 'Música',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-019e-736d-925d-46c5def67350',
                'materia_nombre' => 'Tecnología e Informática',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-01ac-702d-9452-a663b1a9fe3c',
                'materia_nombre' => 'Cátedra para la Paz',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-01ae-77e8-8513-50098114301d',
                'materia_nombre' => 'Lectura Crítica',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-01af-75bc-bc9d-9757e89f8df5',
                'materia_nombre' => 'Gestión Empresarial',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
            [
                'materia_id' => '019717d5-01b2-700d-af91-f0f91548c706',
                'materia_nombre' => 'Ciencias Políticas y Económicas',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137'
            ],
        ]);
    }
}
