<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class create_users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'usuario_id' => 'd436d563-a041-46ef-a951-1ca5ff0067ab',
                'usuario_nombre' => 'Kevin',
                'usuario_apellido' => 'García',
                'usuario_correo' => 'kevin@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1012345678,
                'usuario_nacimiento' => '2006-05-12',
                'usuario_direccion' => 'Cra 10 #20-30, Bogotá',
                'usuario_telefono' => 3101234567,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 1,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'bc2e8ed8-8682-4ffe-b1ac-e8d5f03670be',
                'usuario_nombre' => 'Nestor',
                'usuario_apellido' => 'Gomez Cruz',
                'usuario_correo' => 'ngomez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1033808584,
                'usuario_nacimiento' => '1777-03-12',
                'usuario_direccion' => 'Tv. 70 #65b-75, Bogotá',
                'usuario_telefono' => 3201234545,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 2,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'acc7f7c7-3b60-4a5d-bb2b-433d18d4bca4',
                'usuario_nombre' => 'Samuel',
                'usuario_apellido' => 'Useche Chaparro',
                'usuario_correo' => 'samuuseche01@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1013703730,
                'usuario_nacimiento' => '2007-01-13',
                'usuario_direccion' => 'Cl. 68f Sur #71g-18 a 71g-82, Bogotá',
                'usuario_telefono' => 3107838443,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ]
        ]);

        DB::table('administrativos')->insert([
            [
                'usuario_id' => 'bc2e8ed8-8682-4ffe-b1ac-e8d5f03670be',
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'institucion_id' => '205117f9-fa69-4003-9446-b747e6655ec9',
                'administrativo_cargo' => 'Coordinador',
            ]
        ]);

        DB::table('docentes')->insert([]);

        DB::table('estudiantes')->insert([
            [
                'estudiante_id' => '358f6923-408f-4156-b689-0cd4c62330b5',
                'usuario_id' => 'acc7f7c7-3b60-4a5d-bb2b-433d18d4bca4',
                'institucion_id' => '205117f9-fa69-4003-9446-b747e6655ec9',
            ]
        ]);

        DB::table('tutores')->insert([]);

        DB::table('administrativos_permisos')->insert([
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 1,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 2,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 3,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 4,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 5,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 6,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 7,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 8,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 9,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 10,
            ],
            [
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'permiso_id' => 11,
            ],
        ]);
    }
}
