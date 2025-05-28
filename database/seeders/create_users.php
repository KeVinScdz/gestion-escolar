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
            // ADMINISTRADORES
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
            // RECTOR
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
            // COORDINADOR ACADÉMICO
            [
                'usuario_id' => '6e21d2f5-098e-4ba8-bde5-6c5459adcfef',
                'usuario_nombre' => 'Diana',
                'usuario_apellido' => 'Martínez',
                'usuario_correo' => 'diana.martinez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1029384756,
                'usuario_nacimiento' => '1985-09-20',
                'usuario_direccion' => 'Calle 15 #45-12, Bogotá',
                'usuario_telefono' => 3109988776,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 2,
                'created_at' => now(),
                'updated_at' => null,
            ],
            // COORDINADOR DE CONVIVENCIA
            [
                'usuario_id' => 'db7fd923-91e3-48a2-a4c2-9066d2d8d167',
                'usuario_nombre' => 'Carlos',
                'usuario_apellido' => 'López',
                'usuario_correo' => 'carlos.lopez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1098765432,
                'usuario_nacimiento' => '1990-02-10',
                'usuario_direccion' => 'Av. 68 #10-50, Bogotá',
                'usuario_telefono' => 3206655443,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 2,
                'created_at' => now(),
                'updated_at' => null,
            ],
            // AUXILIAR ADMINISTRATIVO
            [
                'usuario_id' => '9c5b484f-b5a6-459d-9819-d1848ce07ede',
                'usuario_nombre' => 'Lina',
                'usuario_apellido' => 'Torres',
                'usuario_correo' => 'lina.torres@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1054321987,
                'usuario_nacimiento' => '1995-11-05',
                'usuario_direccion' => 'Cra 22 #75-10, Bogotá',
                'usuario_telefono' => 3118877665,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 2,
                'created_at' => now(),
                'updated_at' => null,
            ],
            // CONTABILIDAD
            [
                'usuario_id' => '8216e239-ee59-4f30-b7e5-e3ed77643cfc',
                'usuario_nombre' => 'Oscar',
                'usuario_apellido' => 'Ramírez',
                'usuario_correo' => 'oscar.ramirez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1043219876,
                'usuario_nacimiento' => '1980-07-15',
                'usuario_direccion' => 'Cl. 80 #24-10, Bogotá',
                'usuario_telefono' => 3105544332,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 2,
                'created_at' => now(),
                'updated_at' => null,
            ],
            // DOCENTES
            [
                'usuario_id' => '0822d067-f27e-4f27-b858-11dd9c5b271a',
                'usuario_nombre' => 'María',
                'usuario_apellido' => 'Pérez',
                'usuario_correo' => 'maria.perez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1010101010,
                'usuario_nacimiento' => '1992-08-21',
                'usuario_direccion' => 'Cra 9 #45-67, Bogotá',
                'usuario_telefono' => 3101234000,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 3,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => '9b8e34a9-743d-4425-a6f4-ab661d53bd8c',
                'usuario_nombre' => 'Juan',
                'usuario_apellido' => 'Mendoza',
                'usuario_correo' => 'juan.mendoza@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1010202020,
                'usuario_nacimiento' => '1991-06-30',
                'usuario_direccion' => 'Cl. 60 #70-40, Bogotá',
                'usuario_telefono' => 3106543210,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 3,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'eee75ba6-a7c1-4f11-9d05-524e39d347bc',
                'usuario_nombre' => 'Laura',
                'usuario_apellido' => 'Fernández',
                'usuario_correo' => 'laura.fernandez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1010303030,
                'usuario_nacimiento' => '1993-10-10',
                'usuario_direccion' => 'Cl. 25 #10-20, Bogotá',
                'usuario_telefono' => 3201122334,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 3,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'b6e15a77-215a-4c6c-b487-e3107df4f805',
                'usuario_nombre' => 'Luis',
                'usuario_apellido' => 'Moreno',
                'usuario_correo' => 'luis.moreno@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1010404040,
                'usuario_nacimiento' => '1990-03-03',
                'usuario_direccion' => 'Av. Suba #101-23, Bogotá',
                'usuario_telefono' => 3112233445,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 3,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'a3d16596-6eb9-44e9-b32f-756285a1e927',
                'usuario_nombre' => 'Natalia',
                'usuario_apellido' => 'Suárez',
                'usuario_correo' => 'natalia.suarez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1010505050,
                'usuario_nacimiento' => '1988-12-12',
                'usuario_direccion' => 'Cl. 100 #50-20, Bogotá',
                'usuario_telefono' => 3123344556,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 3,
                'created_at' => now(),
                'updated_at' => null,
            ],
            // ALUMNOS
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
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'administrativo_cargo' => 'Rector',
            ],
            [
                'usuario_id' => '6e21d2f5-098e-4ba8-bde5-6c5459adcfef',
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'administrativo_cargo' => 'Coordinador Académico',
            ],
            [
                'usuario_id' => 'db7fd923-91e3-48a2-a4c2-9066d2d8d167',
                'administrativo_id' => '95a75839-ae5f-4e07-b366-a568ec1a35ab',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'administrativo_cargo' => 'Coordinador de Convivencia',
            ],
            [
                'usuario_id' => '9c5b484f-b5a6-459d-9819-d1848ce07ede',
                'administrativo_id' => '45beced2-d975-468c-a31c-536f4b5744e3',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'administrativo_cargo' => 'Auxiliar Administrativo',
            ],
            [
                'usuario_id' => '8216e239-ee59-4f30-b7e5-e3ed77643cfc',
                'administrativo_id' => 'ed63f2b9-9c47-4434-9de8-c9cbc8b0fb59',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'administrativo_cargo' => 'Contador',
            ],
        ]);

        DB::table('docentes')->insert([

            [
                'usuario_id' => '0822d067-f27e-4f27-b858-11dd9c5b271a',
                'docente_id' => 'a03da01f-ebd0-4d7d-91c2-d70f8a053348',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'docente_titulo' => 'Docente de Matemáticas'
            ],
            [
                'usuario_id' => '9b8e34a9-743d-4425-a6f4-ab661d53bd8c',
                'docente_id' => '9387b98b-1963-4528-8e4d-7efcde01c396',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'docente_titulo' => 'Docente de Lengua Castellana'
            ],
            [
                'usuario_id' => 'eee75ba6-a7c1-4f11-9d05-524e39d347bc',
                'docente_id' => 'c163c21f-4204-468e-90a8-9725411d7833',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'docente_titulo' => 'Docente de Ciencias Naturales'
            ],
            [
                'usuario_id' => 'b6e15a77-215a-4c6c-b487-e3107df4f805',
                'docente_id' => '0515d9d8-e261-4f83-9c71-3db614d76f6b',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'docente_titulo' => 'Docente de Ciencias Sociales'
            ],
            [
                'usuario_id' => 'a3d16596-6eb9-44e9-b32f-756285a1e927',
                'docente_id' => 'cc4d28f9-8d77-4c0e-b9c7-39fbc54d69b8',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'docente_titulo' => 'Docente de Inglés'
            ],
        ]);

        DB::table('estudiantes')->insert([
            [
                'estudiante_id' => '358f6923-408f-4156-b689-0cd4c62330b5',
                'usuario_id' => 'acc7f7c7-3b60-4a5d-bb2b-433d18d4bca4',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
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
