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
            // Gestión de usuarios
            ['permiso_id' => 1, 'permiso_nombre' => 'crear_usuarios'],
            ['permiso_id' => 2, 'permiso_nombre' => 'editar_usuarios'],
            ['permiso_id' => 3, 'permiso_nombre' => 'eliminar_usuarios'],
            ['permiso_id' => 4, 'permiso_nombre' => 'ver_usuarios'],

            // Gestión de roles y permisos
            ['permiso_id' => 5, 'permiso_nombre' => 'gestionar_roles'],
            ['permiso_id' => 6, 'permiso_nombre' => 'gestionar_permisos'],

            // Gestión académica
            ['permiso_id' => 7, 'permiso_nombre' => 'crear_grupos'],
            ['permiso_id' => 8, 'permiso_nombre' => 'asignar_docentes'],
            ['permiso_id' => 9, 'permiso_nombre' => 'gestionar_materias'],
            ['permiso_id' => 10, 'permiso_nombre' => 'gestionar_horarios'],
            ['permiso_id' => 11, 'permiso_nombre' => 'gestionar_periodos'],
            ['permiso_id' => 12, 'permiso_nombre' => 'ver_estructura_academica'],

            // Matrículas
            ['permiso_id' => 13, 'permiso_nombre' => 'registrar_matriculas'],
            ['permiso_id' => 14, 'permiso_nombre' => 'ver_matriculas'],

            // Notas
            ['permiso_id' => 15, 'permiso_nombre' => 'registrar_notas'],
            ['permiso_id' => 16, 'permiso_nombre' => 'ver_notas'],

            // Inasistencias
            ['permiso_id' => 17, 'permiso_nombre' => 'registrar_inasistencias'],
            ['permiso_id' => 18, 'permiso_nombre' => 'ver_inasistencias'],

            // Observaciones
            ['permiso_id' => 19, 'permiso_nombre' => 'registrar_observaciones'],
            ['permiso_id' => 20, 'permiso_nombre' => 'ver_observaciones'],

            // Pagos y Finanzas
            ['permiso_id' => 21, 'permiso_nombre' => 'gestionar_conceptos_pago'],
            ['permiso_id' => 22, 'permiso_nombre' => 'registrar_pagos'],
            ['permiso_id' => 23, 'permiso_nombre' => 'ver_pagos'],

            // Logs del sistema
            ['permiso_id' => 24, 'permiso_nombre' => 'ver_logs'],

            // Configuración institucional
            ['permiso_id' => 25, 'permiso_nombre' => 'gestionar_institucion'],

            // Datos personales
            ['permiso_id' => 26, 'permiso_nombre' => 'ver_perfil_personal'],
            ['permiso_id' => 27, 'permiso_nombre' => 'editar_perfil_personal'],
        ]);

        DB::table('roles_permisos')->insert([
            // ADMINISTRADOR (rol_id = 1) - acceso completo
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
            ['rol_id' => 1, 'permiso_id' => 15],
            ['rol_id' => 1, 'permiso_id' => 16],
            ['rol_id' => 1, 'permiso_id' => 17],
            ['rol_id' => 1, 'permiso_id' => 18],
            ['rol_id' => 1, 'permiso_id' => 19],
            ['rol_id' => 1, 'permiso_id' => 20],
            ['rol_id' => 1, 'permiso_id' => 21],
            ['rol_id' => 1, 'permiso_id' => 22],
            ['rol_id' => 1, 'permiso_id' => 23],
            ['rol_id' => 1, 'permiso_id' => 24],
            ['rol_id' => 1, 'permiso_id' => 25],
            ['rol_id' => 1, 'permiso_id' => 26],
            ['rol_id' => 1, 'permiso_id' => 27],

            // ADMINISTRATIVO (rol_id = 2)
            ['rol_id' => 2, 'permiso_id' => 1],
            ['rol_id' => 2, 'permiso_id' => 2],
            ['rol_id' => 2, 'permiso_id' => 3],
            ['rol_id' => 2, 'permiso_id' => 4],
            ['rol_id' => 2, 'permiso_id' => 7],
            ['rol_id' => 2, 'permiso_id' => 8],
            ['rol_id' => 2, 'permiso_id' => 9],
            ['rol_id' => 2, 'permiso_id' => 10],
            ['rol_id' => 2, 'permiso_id' => 11],
            ['rol_id' => 2, 'permiso_id' => 12],
            ['rol_id' => 2, 'permiso_id' => 13],
            ['rol_id' => 2, 'permiso_id' => 14],
            ['rol_id' => 2, 'permiso_id' => 21],
            ['rol_id' => 2, 'permiso_id' => 22],
            ['rol_id' => 2, 'permiso_id' => 23],
            ['rol_id' => 2, 'permiso_id' => 24],
            ['rol_id' => 2, 'permiso_id' => 25],
            ['rol_id' => 2, 'permiso_id' => 26],
            ['rol_id' => 2, 'permiso_id' => 27],

            // DOCENTE (rol_id = 3)
            ['rol_id' => 3, 'permiso_id' => 12],
            ['rol_id' => 3, 'permiso_id' => 15],
            ['rol_id' => 3, 'permiso_id' => 16],
            ['rol_id' => 3, 'permiso_id' => 17],
            ['rol_id' => 3, 'permiso_id' => 18],
            ['rol_id' => 3, 'permiso_id' => 19],
            ['rol_id' => 3, 'permiso_id' => 20],
            ['rol_id' => 3, 'permiso_id' => 26],
            ['rol_id' => 3, 'permiso_id' => 27],

            // ESTUDIANTE (rol_id = 4)
            ['rol_id' => 4, 'permiso_id' => 16],
            ['rol_id' => 4, 'permiso_id' => 18],
            ['rol_id' => 4, 'permiso_id' => 20],
            ['rol_id' => 4, 'permiso_id' => 23],
            ['rol_id' => 4, 'permiso_id' => 26],
            ['rol_id' => 4, 'permiso_id' => 27],

            // PADRE/MADRE/TUTOR (rol_id = 5)
            ['rol_id' => 5, 'permiso_id' => 16],
            ['rol_id' => 5, 'permiso_id' => 18],
            ['rol_id' => 5, 'permiso_id' => 20],
            ['rol_id' => 5, 'permiso_id' => 23],
            ['rol_id' => 5, 'permiso_id' => 26],
            ['rol_id' => 5, 'permiso_id' => 27],
        ]);

        DB::table('instituciones')->insert([
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
    }
}
