<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_school extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

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


        DB::table('bloques')->insert([
            // Lunes
            [
                'bloque_id' => '598956ac-93be-4aec-9b1a-c2f5e9d775fe',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Lunes',
                'bloque_inicio' => '07:00:00',
                'bloque_fin' => '08:00:00',
            ],
            [
                'bloque_id' => '982bcce7-d768-4382-890e-2a23b2bf1cb0',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Lunes',
                'bloque_inicio' => '08:00:00',
                'bloque_fin' => '09:00:00',
            ],
            [
                'bloque_id' => 'f1588930-93db-445b-8f44-6b61f086e49d',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Lunes',
                'bloque_inicio' => '09:30:00',
                'bloque_fin' => '10:30:00',
            ],
            [
                'bloque_id' => '808ee534-5b19-4de2-af6c-14e778bce12c',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Lunes',
                'bloque_inicio' => '10:30:00',
                'bloque_fin' => '11:30:00',
            ],

            // Martes
            [
                'bloque_id' => '8d91eec8-473e-4e02-853c-926677fb0fe3',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Martes',
                'bloque_inicio' => '07:00:00',
                'bloque_fin' => '08:00:00',
            ],
            [
                'bloque_id' => 'e42abe8f-b535-4fed-8330-228614104cd3',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Martes',
                'bloque_inicio' => '08:00:00',
                'bloque_fin' => '09:00:00',
            ],
            [
                'bloque_id' => '0b8bf9c5-e1ec-443d-b953-8ed7a55ebdc8',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Martes',
                'bloque_inicio' => '09:30:00',
                'bloque_fin' => '10:30:00',
            ],
            [
                'bloque_id' => 'b5f18dda-e7d5-4822-91b8-a7088a0f9db7',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Martes',
                'bloque_inicio' => '10:30:00',
                'bloque_fin' => '11:30:00',
            ],

            // Miércoles
            [
                'bloque_id' => '08e7b669-c301-4106-abfd-68140b8db9f5',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Miércoles',
                'bloque_inicio' => '07:00:00',
                'bloque_fin' => '08:00:00',
            ],
            [
                'bloque_id' => 'f0f3e200-6ba4-4903-9119-342854071686',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Miércoles',
                'bloque_inicio' => '08:00:00',
                'bloque_fin' => '09:00:00',
            ],
            [
                'bloque_id' => 'e03eb3c0-4f9a-4913-a82d-699e6402466a',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Miércoles',
                'bloque_inicio' => '09:30:00',
                'bloque_fin' => '10:30:00',
            ],
            [
                'bloque_id' => '8ffbcbe5-0a4d-45bb-bb71-c8bd614ccc3d',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Miércoles',
                'bloque_inicio' => '10:30:00',
                'bloque_fin' => '11:30:00',
            ],

            // Jueves
            [
                'bloque_id' => '22c2c692-7045-4afb-8127-660d190abcd3',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Jueves',
                'bloque_inicio' => '07:00:00',
                'bloque_fin' => '08:00:00',
            ],
            [
                'bloque_id' => '54fc4660-6c70-4e07-ad09-0bbd20c1b9a7',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Jueves',
                'bloque_inicio' => '08:00:00',
                'bloque_fin' => '09:00:00',
            ],
            [
                'bloque_id' => '2b55b621-3509-4855-a224-f48072a3acff',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Jueves',
                'bloque_inicio' => '09:30:00',
                'bloque_fin' => '10:30:00',
            ],
            [
                'bloque_id' => '74610303-7f02-4a7a-accd-b3874dd2fadb',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Jueves',
                'bloque_inicio' => '10:30:00',
                'bloque_fin' => '11:30:00',
            ],

            // Viernes
            [
                'bloque_id' => '24f88fec-18ac-498e-a980-47ffa90926a5',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Viernes',
                'bloque_inicio' => '07:00:00',
                'bloque_fin' => '08:00:00',
            ],
            [
                'bloque_id' => '55ee9bf7-fecd-46ed-a5db-b35c9fc48344',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Viernes',
                'bloque_inicio' => '08:00:00',
                'bloque_fin' => '09:00:00',
            ],
            [
                'bloque_id' => '144944c0-25c4-4000-a4be-6061587232f6',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Viernes',
                'bloque_inicio' => '09:30:00',
                'bloque_fin' => '10:30:00',
            ],
            [
                'bloque_id' => '585d0e0c-f073-4355-91a1-ad59149fbefc',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'bloque_dia' => 'Viernes',
                'bloque_inicio' => '10:30:00',
                'bloque_fin' => '11:30:00',
            ],
        ]);


        DB::table('asignaciones')->insert([
            // Undécimo A
            [
                'asignacion_id' => '17874d94-07fb-418e-91b2-58b42a760f86',
                'docente_id' => '0515d9d8-e261-4f83-9c71-3db614d76f6b', // Ciencias Sociales
                'materia_id' => '019717d5-0114-7069-898b-47696dd7a6e8',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
            ],
            [
                'asignacion_id' => '1cdaefcc-51a1-47f3-9929-5bbd779a284c',
                'docente_id' => '9387b98b-1963-4528-8e4d-7efcde01c396', // Español y Literatura
                'materia_id' => '019717d5-00df-752a-91a0-1c251cc69836',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
            ],
            [
                'asignacion_id' => 'db4a2660-1883-485c-a72c-70c8cb733ec3',
                'docente_id' => 'a03da01f-ebd0-4d7d-91c2-d70f8a053348', // Matemáticas
                'materia_id' => '019717d5-0046-772b-b23f-e9c9b2336a63',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
            ],
            [
                'asignacion_id' => '5989cdf2-7ee4-4d73-8d53-3227d7c68402',
                'docente_id' => 'c163c21f-4204-468e-90a8-9725411d7833', // Ciencias Naturales
                'materia_id' => '019717d5-0112-7371-b580-863a91da32c6',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
            ],
            [
                'asignacion_id' => 'fdd390cd-4b6d-4e5e-a55f-6daab00739b8',
                'docente_id' => 'cc4d28f9-8d77-4c0e-b9c7-39fbc54d69b8', // Inglés
                'materia_id' => '019717d5-00e3-7452-9163-e6c495bacb5c',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
            ],

            // Undécimo B (similar asignación)
            [
                'asignacion_id' => '7c7c6c0b-f4af-4a43-9487-664ec9d3364d',
                'docente_id' => '0515d9d8-e261-4f83-9c71-3db614d76f6b',
                'materia_id' => '019717d5-0114-7069-898b-47696dd7a6e8', // Ciencias Sociales
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
            ],
            [
                'asignacion_id' => '01ea6124-c930-4868-a48c-c2e701416e1e',
                'docente_id' => '9387b98b-1963-4528-8e4d-7efcde01c396',
                'materia_id' => '019717d5-00df-752a-91a0-1c251cc69836', // Español y Literatura
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
            ],
            [
                'asignacion_id' => '07710813-e691-4cec-8183-33c7574f3c69',
                'docente_id' => 'a03da01f-ebd0-4d7d-91c2-d70f8a053348',
                'materia_id' => '019717d5-0046-772b-b23f-e9c9b2336a63', // Matemáticas
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
            ],
            [
                'asignacion_id' => '44064d52-5218-42aa-8969-73838caa4735',
                'docente_id' => 'c163c21f-4204-468e-90a8-9725411d7833',
                'materia_id' => '019717d5-0112-7371-b580-863a91da32c6', // Ciencias Naturales
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
            ],
            [
                'asignacion_id' => 'b93700f5-6589-4ea4-8a25-d52c4206d027',
                'docente_id' => 'cc4d28f9-8d77-4c0e-b9c7-39fbc54d69b8',
                'materia_id' => '019717d5-00e3-7452-9163-e6c495bacb5c', // Inglés
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
            ],
        ]);

        DB::table('horarios')->insert([
            // UNDECIMO A
            // Lunes
            ['horario_id' => '9063cd56-a909-495c-ab8e-8f64982bad63', 'bloque_id' => '598956ac-93be-4aec-9b1a-c2f5e9d775fe', 'asignacion_id' => 'db4a2660-1883-485c-a72c-70c8cb733ec3'], // Matemáticas 07-08 Lunes
            ['horario_id' => '5244a0a7-3068-45e9-84c5-994903fca607', 'bloque_id' => '982bcce7-d768-4382-890e-2a23b2bf1cb0', 'asignacion_id' => '17874d94-07fb-418e-91b2-58b42a760f86'], // Ciencias Sociales 08-09 Lunes
            ['horario_id' => '21dbcaff-0d47-4ee3-942f-5c108e974c09', 'bloque_id' => 'f1588930-93db-445b-8f44-6b61f086e49d', 'asignacion_id' => 'fdd390cd-4b6d-4e5e-a55f-6daab00739b8'], // Inglés 09:30-10:30 Lunes
            ['horario_id' => 'b7445eda-9761-4ee9-98d4-5e2cf306e619', 'bloque_id' => '808ee534-5b19-4de2-af6c-14e778bce12c', 'asignacion_id' => '1cdaefcc-51a1-47f3-9929-5bbd779a284c'], // Español 10:30-11:30 Lunes

            // Martes
            ['horario_id' => 'f7199155-dba8-4398-83d7-2bf7f594afa6', 'bloque_id' => '8d91eec8-473e-4e02-853c-926677fb0fe3', 'asignacion_id' => '5989cdf2-7ee4-4d73-8d53-3227d7c68402'], // Ciencias Naturales 07-08 Martes
            ['horario_id' => '416c4810-2df8-4015-bec4-8d84aa82878a', 'bloque_id' => 'e42abe8f-b535-4fed-8330-228614104cd3', 'asignacion_id' => 'fdd390cd-4b6d-4e5e-a55f-6daab00739b8'], // Inglés 08-09 Martes
            ['horario_id' => 'a04e1e8d-ab1e-4c0a-af12-abc1cbae19ee', 'bloque_id' => '0b8bf9c5-e1ec-443d-b953-8ed7a55ebdc8', 'asignacion_id' => 'db4a2660-1883-485c-a72c-70c8cb733ec3'], // Matemáticas 09:30-10:30 Martes
            ['horario_id' => 'b5cdc81a-5205-45a9-a42b-30609be53367', 'bloque_id' => 'b5f18dda-e7d5-4822-91b8-a7088a0f9db7', 'asignacion_id' => '17874d94-07fb-418e-91b2-58b42a760f86'], // Ciencias Sociales 10:30-11:30 Martes

            // Miércoles
            ['horario_id' => '9e4d0654-5b24-42fe-84e5-4160f7e5fc7e', 'bloque_id' => '08e7b669-c301-4106-abfd-68140b8db9f5', 'asignacion_id' => '1cdaefcc-51a1-47f3-9929-5bbd779a284c'], // Español 07-08 Miércoles
            ['horario_id' => '1098f533-56ed-4324-a5cf-f36aa87e0218', 'bloque_id' => 'f0f3e200-6ba4-4903-9119-342854071686', 'asignacion_id' => '5989cdf2-7ee4-4d73-8d53-3227d7c68402'], // Ciencias Naturales 08-09 Miércoles
            ['horario_id' => '61db7e83-acaf-44c9-b3f0-64b96815b4df', 'bloque_id' => 'e03eb3c0-4f9a-4913-a82d-699e6402466a', 'asignacion_id' => '17874d94-07fb-418e-91b2-58b42a760f86'], // Ciencias Sociales 09:30-10:30 Miércoles
            ['horario_id' => '6f906086-6897-4649-8fae-af631a8846ec', 'bloque_id' => '8ffbcbe5-0a4d-45bb-bb71-c8bd614ccc3d', 'asignacion_id' => 'db4a2660-1883-485c-a72c-70c8cb733ec3'], // Matemáticas 10:30-11:30 Miércoles

            // Jueves
            ['horario_id' => 'a45a0321-948d-4082-9fe7-c7711552c8b8', 'bloque_id' => '22c2c692-7045-4afb-8127-660d190abcd3', 'asignacion_id' => 'fdd390cd-4b6d-4e5e-a55f-6daab00739b8'], // Inglés 07-08 Jueves
            ['horario_id' => 'e330c912-6db7-4914-84bf-ed0f730baee7', 'bloque_id' => '54fc4660-6c70-4e07-ad09-0bbd20c1b9a7', 'asignacion_id' => 'db4a2660-1883-485c-a72c-70c8cb733ec3'], // Matemáticas 08-09 Jueves
            ['horario_id' => 'b6149202-383e-4343-af19-4c857aed37e8', 'bloque_id' => '2b55b621-3509-4855-a224-f48072a3acff', 'asignacion_id' => '1cdaefcc-51a1-47f3-9929-5bbd779a284c'], // Español 09:30-10:30 Jueves
            ['horario_id' => 'a80c267e-0635-4ff0-849b-5406d5e43637', 'bloque_id' => '74610303-7f02-4a7a-accd-b3874dd2fadb', 'asignacion_id' => '5989cdf2-7ee4-4d73-8d53-3227d7c68402'], // Ciencias Naturales 10:30-11:30 Jueves

            // Viernes
            ['horario_id' => 'f8aa14a1-b013-4f76-ac17-7b7d2162983e', 'bloque_id' => '24f88fec-18ac-498e-a980-47ffa90926a5', 'asignacion_id' => '17874d94-07fb-418e-91b2-58b42a760f86'], // Ciencias Sociales 07-08 Viernes
            ['horario_id' => 'a0cf59d1-ed35-4dc7-9e1a-03e8b88a0633', 'bloque_id' => '55ee9bf7-fecd-46ed-a5db-b35c9fc48344', 'asignacion_id' => '1cdaefcc-51a1-47f3-9929-5bbd779a284c'], // Español 08-09 Viernes
            ['horario_id' => 'b6279bb6-deaf-4b95-a28b-09c131471b4f', 'bloque_id' => '144944c0-25c4-4000-a4be-6061587232f6', 'asignacion_id' => 'fdd390cd-4b6d-4e5e-a55f-6daab00739b8'], // Inglés 09:30-10:30 Viernes
            ['horario_id' => 'ec338418-89c0-4993-badc-e90674b961a4', 'bloque_id' => '585d0e0c-f073-4355-91a1-ad59149fbefc', 'asignacion_id' => 'db4a2660-1883-485c-a72c-70c8cb733ec3'], // Matemáticas 10:30-11:30 Viernes

            // UNDECIMO B
            // Lunes
            ['horario_id' => '1200e586-baaf-4c71-bbda-a4e473cef360', 'bloque_id' => '598956ac-93be-4aec-9b1a-c2f5e9d775fe', 'asignacion_id' => 'b93700f5-6589-4ea4-8a25-d52c4206d027'], // Inglés 07-08 Lunes
            ['horario_id' => 'eccaff62-2a7a-4ce1-bd72-fca2340f64ae', 'bloque_id' => '982bcce7-d768-4382-890e-2a23b2bf1cb0', 'asignacion_id' => '07710813-e691-4cec-8183-33c7574f3c69'], // Matemáticas 08-09 Lunes
            ['horario_id' => '7ca7abe0-d30f-4f84-9e47-f361927204e6', 'bloque_id' => 'f1588930-93db-445b-8f44-6b61f086e49d', 'asignacion_id' => '44064d52-5218-42aa-8969-73838caa4735'], // Ciencias Naturales 09:30-10:30 Lunes
            ['horario_id' => '8499d173-edb8-49f5-89ea-622c48d8924f', 'bloque_id' => '808ee534-5b19-4de2-af6c-14e778bce12c', 'asignacion_id' => '7c7c6c0b-f4af-4a43-9487-664ec9d3364d'], // Ciencias Sociales 10:30-11:30 Lunes

            // Martes
            ['horario_id' => '98c4c41d-d6ba-48ff-afce-c072fe51d13f', 'bloque_id' => '8d91eec8-473e-4e02-853c-926677fb0fe3', 'asignacion_id' => '07710813-e691-4cec-8183-33c7574f3c69'], // Matemáticas 07-08 Martes
            ['horario_id' => '4e9ba681-d5a5-4104-8359-1e29291b024b', 'bloque_id' => 'e42abe8f-b535-4fed-8330-228614104cd3', 'asignacion_id' => '01ea6124-c930-4868-a48c-c2e701416e1e'], // Español y literatura 08-09 Martes
            ['horario_id' => '119dd2e2-00cb-4b4b-bbdd-1e02747c6a4e', 'bloque_id' => '0b8bf9c5-e1ec-443d-b953-8ed7a55ebdc8', 'asignacion_id' => 'b93700f5-6589-4ea4-8a25-d52c4206d027'], // Ingles 09:30-10:30 Martes
            ['horario_id' => 'cf3ded8a-661c-4292-befe-fd743a29f0e7', 'bloque_id' => 'b5f18dda-e7d5-4822-91b8-a7088a0f9db7', 'asignacion_id' => 'b93700f5-6589-4ea4-8a25-d52c4206d027'], // Ingles 10:30-11:30 Martes

            // Miércoles
            ['horario_id' => '5b06ac51-3e0a-4fa5-86d2-6726b3f80830', 'bloque_id' => '08e7b669-c301-4106-abfd-68140b8db9f5', 'asignacion_id' => '7c7c6c0b-f4af-4a43-9487-664ec9d3364d'], // Ciencias Sociales 07-08 Miércoles
            ['horario_id' => '7d2e9043-d343-48ba-b592-bd6762936ff2', 'bloque_id' => 'f0f3e200-6ba4-4903-9119-342854071686', 'asignacion_id' => '07710813-e691-4cec-8183-33c7574f3c69'], // Matemáticas 08-09 Miércoles
            ['horario_id' => '168752d3-b3bf-4fe4-aa4a-cec4dfe18361', 'bloque_id' => 'e03eb3c0-4f9a-4913-a82d-699e6402466a', 'asignacion_id' => '01ea6124-c930-4868-a48c-c2e701416e1e'], // Español y literatura 09:30-10:30 Miércoles
            ['horario_id' => 'd19d5070-5350-4309-bf9e-c4f140818c96', 'bloque_id' => '8ffbcbe5-0a4d-45bb-bb71-c8bd614ccc3d', 'asignacion_id' => '44064d52-5218-42aa-8969-73838caa4735'], // Ciencias Naturales 10:30-11:30 Miércoles

            // Jueves
            ['horario_id' => 'f4d1c14a-7b57-4a2a-8e38-da50330362d9', 'bloque_id' => '22c2c692-7045-4afb-8127-660d190abcd3', 'asignacion_id' => '01ea6124-c930-4868-a48c-c2e701416e1e'], // Español y literatura 07-08 Jueves
            ['horario_id' => '7b455b77-4886-4c42-93cf-a48dec0420cf', 'bloque_id' => '54fc4660-6c70-4e07-ad09-0bbd20c1b9a7', 'asignacion_id' => 'b93700f5-6589-4ea4-8a25-d52c4206d027'], // Ingles 08-09 Jueves
            ['horario_id' => 'f2648a19-39d3-4ec8-895a-dee7790918cb', 'bloque_id' => '2b55b621-3509-4855-a224-f48072a3acff', 'asignacion_id' => '44064d52-5218-42aa-8969-73838caa4735'], // Ciencias Naturales 09:30-10:30 Jueves
            ['horario_id' => 'ed4a6300-c699-4678-9a8f-c6b0dcd12a98', 'bloque_id' => '74610303-7f02-4a7a-accd-b3874dd2fadb', 'asignacion_id' => '07710813-e691-4cec-8183-33c7574f3c69'], // Matemáticas 10:30-11:30 Jueves

            // Viernes
            ['horario_id' => '380e751c-5f40-4dbd-b322-8f91ada9a952', 'bloque_id' => '24f88fec-18ac-498e-a980-47ffa90926a5', 'asignacion_id' => 'b93700f5-6589-4ea4-8a25-d52c4206d027'], // Ingles 07-08 Viernes
            ['horario_id' => '79731eb2-63ad-42e8-9e6f-2fb7b9627447', 'bloque_id' => '55ee9bf7-fecd-46ed-a5db-b35c9fc48344', 'asignacion_id' => '44064d52-5218-42aa-8969-73838caa4735'], // Ciencias Naturales 08-09 Viernes
            ['horario_id' => '27d703b4-57a6-49f9-a875-1c24b22a472b', 'bloque_id' => '144944c0-25c4-4000-a4be-6061587232f6', 'asignacion_id' => '07710813-e691-4cec-8183-33c7574f3c69'], // Matemáticas 09:30-10:30 Viernes
            ['horario_id' => 'c98a932c-56f5-492b-bdc2-6d292124e7d7', 'bloque_id' => '585d0e0c-f073-4355-91a1-ad59149fbefc', 'asignacion_id' => '01ea6124-c930-4868-a48c-c2e701416e1e'], // Español y literatura 10:30-11:30 Viernes
        ]);

        DB::table('conceptos_pago')->insert([
            // Mensualidades 2025
            [
                'concepto_id' => 'aea675b1-045d-478e-8bd9-374398878bc0',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Enero 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '5ffa9183-dbc5-4efa-94a9-b023ea3e706f',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Febrero 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '309bee77-bae4-4159-8bd9-45b14d6e7441',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Marzo 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '9b9e58b1-88fc-46f0-8391-1ffb4abcca4c',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Abril 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '7ed27e33-89db-47c4-bcba-aa75607d6b95',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Mayo 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => 'e5bb0d19-a93e-470e-9468-2392357f0086',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Junio 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '51aecf85-c7da-4baa-9012-0645641b0d1c',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Julio 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '0b68af28-6755-4959-b5bc-6486f69527d5',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Agosto 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => 'd6608aae-b198-4c60-8396-b23e0c8d0cfa',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Septiembre 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '777a6730-ac1b-49e8-8d67-66af7b477f38',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Octubre 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '5ea25f35-0fd7-44fd-931b-8a97281a9d7a',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Noviembre 2025',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => 'e6260c3a-5edc-46b1-b899-766e679cb4ab',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Diciembre 2025',
                'concepto_valor' => 100000,
            ],

            // Mensualidades 2026
            [
                'concepto_id' => 'a679e658-a023-4f79-a8d9-ad0c2622aeec',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Enero 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '243ee34c-19d0-4ba1-b096-b49a08873a96',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Febrero 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '0e6ee2bd-69e3-4f39-8746-8db3cb56170c',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Marzo 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => 'f9ae5f69-1e54-4472-8ca1-c98d682308df',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Abril 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => 'ef59eeb9-5189-40f1-ba37-b478ec7e2aa3',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Mayo 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '6ae10952-ad07-41cf-8ff4-2c5785558b98',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Junio 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '4f9fc927-601b-4c2f-8fa3-6b7c2a11d06d',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Julio 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '3fe73835-a691-462e-865c-4f83c6596a2e',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Agosto 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '0e3c933f-e9a2-45ae-aabb-0651a0a33670',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Septiembre 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '85708fee-4bf1-4182-8a03-7c424eab2bf3',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Octubre 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => '737080c3-8a79-48e2-a295-36e5ba3d9302',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Noviembre 2026',
                'concepto_valor' => 100000,
            ],
            [
                'concepto_id' => 'c72aa996-5bd3-4b6a-83a2-cf39cbb111bd',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'concepto_nombre' => 'Mensualidad Diciembre 2026',
                'concepto_valor' => 100000,
            ],
        ]);


        DB::table('observaciones')->insert([
            [
                'observacion_id' => '2696bae5-a2b1-4f80-887d-e8808afe638b',
                'matricula_id' => '0ec23155-b327-4386-8895-df34c355c6e2',
                'observacion_tipo' => 'falta de participación',
                'observacion_descripcion' => 'El estudiante no participa en las actividades de clase.',
                'observacion_fecha' => '2025-03-15',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'observacion_id' => '3589999e-666c-4f88-8e10-7e0eb4e5db0a',
                'matricula_id' => 'f4ff4f51-0303-4035-a865-9d7df3783e2d',
                'observacion_tipo' => 'bajo rendimiento',
                'observacion_descripcion' => 'Necesita mejorar la entrega de tareas.',
                'observacion_fecha' => '2025-04-10',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'observacion_id' => '54cb2fc2-0772-42b0-b924-573c19a29f93',
                'matricula_id' => '54cb2fc2-0772-42b0-b924-573c19a29f93',
                'observacion_tipo' => 'observación general',
                'observacion_descripcion' => 'El estudiante no asiste a clases con regularidad.',
                'observacion_fecha' => '2025-05-05',
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);
    }
}
