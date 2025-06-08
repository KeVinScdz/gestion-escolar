<?php

namespace Database\Seeders;

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
                'usuario_nombre' => 'Kevin Andrés',
                'usuario_apellido' => 'Muñoz García',
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
                'usuario_nombre' => 'Nestor Alonso',
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
                'usuario_nombre' => 'Diana Carolina',
                'usuario_apellido' => 'Martínez López',
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
                'usuario_nombre' => 'Carlos Alberto',
                'usuario_apellido' => 'López Pérez',
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
                'usuario_nombre' => 'Lina María',
                'usuario_apellido' => 'Torres Vargas',
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
                'usuario_nombre' => 'Oscar Iván',
                'usuario_apellido' => 'Ramírez Sánchez',
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
                'usuario_nombre' => 'María Camila',
                'usuario_apellido' => 'Pérez Gómez',
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
                'usuario_nombre' => 'Juan David',
                'usuario_apellido' => 'Mendoza Ruiz',
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
                'usuario_nombre' => 'Laura Sofía',
                'usuario_apellido' => 'Fernández Díaz',
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
                'usuario_nombre' => 'Luis Fernando',
                'usuario_apellido' => 'Moreno Silva',
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
                'usuario_nombre' => 'Natalia Andrea',
                'usuario_apellido' => 'Suárez Castro',
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
                'usuario_nombre' => 'Samuel David',
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
            ],
            [
                'usuario_id' => 'abaaee03-dec0-409f-98e7-082c24f86424',
                'usuario_nombre' => 'Camila Andrea',
                'usuario_apellido' => 'Ramírez Torres',
                'usuario_correo' => 'camila.ramirez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1012222222,
                'usuario_nacimiento' => '2007-02-14',
                'usuario_direccion' => 'Cl. 21 #45-67, Bogotá',
                'usuario_telefono' => 3102222222,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => '05253f46-4b3e-4c0e-ac55-b1ab50aa36f3',
                'usuario_nombre' => 'Felipe Andrés',
                'usuario_apellido' => 'López Vargas',
                'usuario_correo' => 'felipe.lopez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1013333333,
                'usuario_nacimiento' => '2007-03-22',
                'usuario_direccion' => 'Av. 1 #10-20, Bogotá',
                'usuario_telefono' => 3103333333,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'ecfa31b1-529a-40cf-adca-a959672fb16a',
                'usuario_nombre' => 'Valentina',
                'usuario_apellido' => 'Martínez Sánchez',
                'usuario_correo' => 'valentina.martinez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1014444444,
                'usuario_nacimiento' => '2006-07-19',
                'usuario_direccion' => 'Cl. 55 #10-55, Bogotá',
                'usuario_telefono' => 3104444444,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => '99ff4b18-85c5-4086-a50c-cf6bb5371ebe',
                'usuario_nombre' => 'Sofía Alejandra',
                'usuario_apellido' => 'Castro Gómez',
                'usuario_correo' => 'sofia.castro@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1015555555,
                'usuario_nacimiento' => '2007-09-01',
                'usuario_direccion' => 'Cl. 9 #15-30, Bogotá',
                'usuario_telefono' => 3105555555,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => '9bd53343-7286-44d1-b54e-cbbf480f84c1',
                'usuario_nombre' => 'Daniel Felipe',
                'usuario_apellido' => 'Rojas Ruiz',
                'usuario_correo' => 'daniel.rojas@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1016666666,
                'usuario_nacimiento' => '2006-10-11',
                'usuario_direccion' => 'Av. Suba #100-50, Bogotá',
                'usuario_telefono' => 3106666666,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => '629d01c9-3cea-4403-97bd-6da95c5e44bf',
                'usuario_nombre' => 'Luisa Fernanda',
                'usuario_apellido' => 'Fernández Díaz',
                'usuario_correo' => 'luisa.fernandez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1017777777,
                'usuario_nacimiento' => '2007-04-23',
                'usuario_direccion' => 'Cl. 32 #11-22, Bogotá',
                'usuario_telefono' => 3107777777,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => '43a51cd2-ceda-46ea-b723-801d101e88a4',
                'usuario_nombre' => 'Sebastián Mateo',
                'usuario_apellido' => 'Muñoz Silva',
                'usuario_correo' => 'sebastian.munoz@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1018888888,
                'usuario_nacimiento' => '2006-12-02',
                'usuario_direccion' => 'Cl. 80 #100-10, Bogotá',
                'usuario_telefono' => 3108888888,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'a530f503-2040-4658-a0ac-0fb1f10c727f',
                'usuario_nombre' => 'Isabella',
                'usuario_apellido' => 'Gómez Castro',
                'usuario_correo' => 'isabella.gomez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1019999999,
                'usuario_nacimiento' => '2007-08-15',
                'usuario_direccion' => 'Cra. 15 #70-30, Bogotá',
                'usuario_telefono' => 3109999999,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'ed9cd8f0-4f51-4101-bd3b-3466991168c6',
                'usuario_nombre' => 'Tomás Alejandro',
                'usuario_apellido' => 'Herrera Pérez',
                'usuario_correo' => 'tomas.herrera@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1020000000,
                'usuario_nacimiento' => '2006-05-05',
                'usuario_direccion' => 'Cl. 13 #20-12, Bogotá',
                'usuario_telefono' => 3110000000,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 4,
                'created_at' => now(),
                'updated_at' => null,
            ],
            // TUTORES
            [
                'usuario_id' => '7fb32471-df2d-46e7-bb94-b893229459f9',
                'usuario_nombre' => 'Claudia Patricia',
                'usuario_apellido' => 'Mendoza López',
                'usuario_correo' => 'claudia.mendoza@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1001234567,
                'usuario_nacimiento' => '1980-05-10',
                'usuario_direccion' => 'Cl. 100 #10-20, Bogotá',
                'usuario_telefono' => 3201234567,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 5,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'a5af0345-cdd4-48bc-8d6c-18d373004c28',
                'usuario_nombre' => 'Jorge Luis',
                'usuario_apellido' => 'Pérez Ramírez',
                'usuario_correo' => 'jorge.perez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1002345678,
                'usuario_nacimiento' => '1975-08-25',
                'usuario_direccion' => 'Cra. 50 #45-33, Bogotá',
                'usuario_telefono' => 3202345678,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 5,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => 'c00a82af-9484-4509-80ff-039997f4369f',
                'usuario_nombre' => 'Sandra Milena',
                'usuario_apellido' => 'Gómez Vargas',
                'usuario_correo' => 'sandra.gomez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1003456789,
                'usuario_nacimiento' => '1985-03-17',
                'usuario_direccion' => 'Av. 68 #45-67, Bogotá',
                'usuario_telefono' => 3203456789,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 5,
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'usuario_id' => '671336af-c528-451a-b0bd-eb16b69603bb',
                'usuario_nombre' => 'Luis Carlos',
                'usuario_apellido' => 'Ramírez Sánchez',
                'usuario_correo' => 'luis.ramirez@gmail.com',
                'usuario_documento_tipo' => 'CC',
                'usuario_documento' => 1004567890,
                'usuario_nacimiento' => '1982-11-30',
                'usuario_direccion' => 'Cl. 45 #100-10, Bogotá',
                'usuario_telefono' => 3204567890,
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 5,
                'created_at' => now(),
                'updated_at' => null,
            ],
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
                'estudiante_id' => '61417e28-03b5-425e-9553-4a900f22b47e',
                'usuario_id' => 'acc7f7c7-3b60-4a5d-bb2b-433d18d4bca4',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estudiante_id' => 'e16fa3a8-ac43-4d70-8bf1-9826a7547fc7',
                'usuario_id' => 'abaaee03-dec0-409f-98e7-082c24f86424',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => '1712b8e4-f374-48fe-8b67-c55e678f5289',
                'usuario_id' => '05253f46-4b3e-4c0e-ac55-b1ab50aa36f3',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => '0becf5c7-b3a5-46b3-b91d-ceb6694dbac5',
                'usuario_id' => 'ecfa31b1-529a-40cf-adca-a959672fb16a',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => 'a4cb54b8-5910-4dbf-9a6d-4b5d08e2ba26',
                'usuario_id' => '99ff4b18-85c5-4086-a50c-cf6bb5371ebe',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => '8583ffac-e87d-496a-ae23-5253236c3d0a',
                'usuario_id' => '9bd53343-7286-44d1-b54e-cbbf480f84c1',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => '34bcd5fe-b2e3-4eeb-ba0a-5f275d41cbb4',
                'usuario_id' => '629d01c9-3cea-4403-97bd-6da95c5e44bf',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => 'bb89ea00-07a4-4aa0-a489-4d5c276bd04c',
                'usuario_id' => '43a51cd2-ceda-46ea-b723-801d101e88a4',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => '3e5735bd-cc18-4a5e-b725-424f05764ba3',
                'usuario_id' => 'a530f503-2040-4658-a0ac-0fb1f10c727f',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'estudiante_id' => 'c97d9f17-5ad3-4232-8bda-dc1a77326c77',
                'usuario_id' => 'ed9cd8f0-4f51-4101-bd3b-3466991168c6',
                'institucion_id' => 'dbf5dd93-aa04-486a-a6d5-a9a1f9129137',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('tutores')->insert([
            // Claudia Mendoza - tutor de Samuel y Camila
            [
                'tutor_id' => '9f8eabb7-0f8b-4224-974c-2c6276020473',
                'usuario_id' => '7fb32471-df2d-46e7-bb94-b893229459f9',
                'estudiante_id' => '61417e28-03b5-425e-9553-4a900f22b47e', // Samuel
            ],
            [
                'tutor_id' => '689a13a9-4df8-45a2-ace6-b3a94f872015',
                'usuario_id' => '7fb32471-df2d-46e7-bb94-b893229459f9',
                'estudiante_id' => 'e16fa3a8-ac43-4d70-8bf1-9826a7547fc7', // Camila
            ],

            // Jorge Pérez - tutor de Felipe y Valentina
            [
                'tutor_id' => '217fe284-34f9-4f11-8b0a-7c571b91b04f',
                'usuario_id' => 'a5af0345-cdd4-48bc-8d6c-18d373004c28',
                'estudiante_id' => '1712b8e4-f374-48fe-8b67-c55e678f5289', // Felipe
            ],
            [
                'tutor_id' => '4e09b989-29b0-4038-a2fb-def9d2c990dc',
                'usuario_id' => 'a5af0345-cdd4-48bc-8d6c-18d373004c28',
                'estudiante_id' => '0becf5c7-b3a5-46b3-b91d-ceb6694dbac5', // Valentina
            ],

            // Sandra Gómez - tutor de Sofía y Daniel
            [
                'tutor_id' => 'ef24bdb7-271d-492d-8808-d3fa61c06e88',
                'usuario_id' => 'c00a82af-9484-4509-80ff-039997f4369f',
                'estudiante_id' => 'a4cb54b8-5910-4dbf-9a6d-4b5d08e2ba26', // Sofía
            ],

            // Luis Ramírez - tutor de Luisa
            [
                'tutor_id' => '1c8d8b2a-0ff2-487e-b9e5-040dc38ec225',
                'usuario_id' => '671336af-c528-451a-b0bd-eb16b69603bb',
                'estudiante_id' => '34bcd5fe-b2e3-4eeb-ba0a-5f275d41cbb4', // Luisa
            ],
        ]);


        DB::table('administrativos_permisos')->insert([
            // RECTOR
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
            // COORDINADOR ACADÉMICO
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 1,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 2,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 3,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 4,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 5,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 6,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 7,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 8,
            ],
            [
                'administrativo_id' => '4e2561c2-04e1-4cdc-891c-be91b8608879',
                'permiso_id' => 9,
            ],
            // COORDINADOR DE CONVIVENCIA
            [
                'administrativo_id' => '95a75839-ae5f-4e07-b366-a568ec1a35ab',
                'permiso_id' => 4,
            ],
            [
                'administrativo_id' => '95a75839-ae5f-4e07-b366-a568ec1a35ab',
                'permiso_id' => 9,
            ],
            [
                'administrativo_id' => '95a75839-ae5f-4e07-b366-a568ec1a35ab',
                'permiso_id' => 10,
            ],
            // CONTABILIDAD
            [
                'administrativo_id' => 'ed63f2b9-9c47-4434-9de8-c9cbc8b0fb59',
                'permiso_id' => 11,
            ],
        ]);

        DB::table('matriculas')->insert([
            [
                'matricula_id' => '0ec23155-b327-4386-8895-df34c355c6e2',
                'estudiante_id' => '61417e28-03b5-425e-9553-4a900f22b47e',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34', // Undécimo A
                'matricula_año' => 2025,
            ],
            [
                'matricula_id' => 'f4ff4f51-0303-4035-a865-9d7df3783e2d',
                'estudiante_id' => 'e16fa3a8-ac43-4d70-8bf1-9826a7547fc7',
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee', // Undécimo B
                'matricula_año' => 2025,
            ],
            [
                'matricula_id' => '54cb2fc2-0772-42b0-b924-573c19a29f93',
                'estudiante_id' => '1712b8e4-f374-48fe-8b67-c55e678f5289',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
                'matricula_año' => 2025,
            ],
            [
                'matricula_id' => '917ea396-7bee-43bb-b189-6c03d26245a3',
                'estudiante_id' => '0becf5c7-b3a5-46b3-b91d-ceb6694dbac5',
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
                'matricula_año' => 2025,
            ],
            [
                'matricula_id' => '3133ad86-04fd-4f8d-8ca1-b59d10d40151',
                'estudiante_id' => 'a4cb54b8-5910-4dbf-9a6d-4b5d08e2ba26',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
                'matricula_año' => 2025,
            ],
            [
                'matricula_id' => '4b9e0ade-83a2-4d10-98f0-3c9f87bbd554',
                'estudiante_id' => '8583ffac-e87d-496a-ae23-5253236c3d0a',
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
                'matricula_año' => 2025,
            ],
            [
                'matricula_id' => '4e6e0961-412d-4b0c-9ec8-3304c7cbefcb',
                'estudiante_id' => '34bcd5fe-b2e3-4eeb-ba0a-5f275d41cbb4',
                'grupo_id' => '019717a9-de29-775e-ae2e-5aeb8416dd34',
                'matricula_año' => 2025,
            ],
            [
                'matricula_id' => '67852d80-fd41-49cc-8829-78109ac9927d',
                'estudiante_id' => 'bb89ea00-07a4-4aa0-a489-4d5c276bd04c',
                'grupo_id' => '019717a9-de2a-714b-b396-110996b777ee',
                'matricula_año' => 2025,
            ],
        ]);

        DB::table('pagos')->insert([
            // Pagos de matrícula_id: 0ec23155-b327-4386-8895-df34c355c6e2
            [
                'pago_id' => '1f7d0b88-1c0e-4a3b-b8ed-fcb1e9b8a100',
                'matricula_id' => '0ec23155-b327-4386-8895-df34c355c6e2',
                'concepto_id' => 'aea675b1-045d-478e-8bd9-374398878bc0',
                'pago_fecha' => '2025-01-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => '7308462a-3e7f-4e77-9421-b97c7e3e82a1',
                'matricula_id' => '0ec23155-b327-4386-8895-df34c355c6e2',
                'concepto_id' => '5ffa9183-dbc5-4efa-94a9-b023ea3e706f',
                'pago_fecha' => '2025-02-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => 'e9093ac4-67f9-476e-8d68-7c6b30db42ef',
                'matricula_id' => '0ec23155-b327-4386-8895-df34c355c6e2',
                'concepto_id' => '309bee77-bae4-4159-8bd9-45b14d6e7441',
                'pago_fecha' => '2025-03-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => '969fe15f-7df2-4a86-a2f3-c6823a5b1f8d',
                'matricula_id' => '0ec23155-b327-4386-8895-df34c355c6e2',
                'concepto_id' => '9b9e58b1-88fc-46f0-8391-1ffb4abcca4c',
                'pago_fecha' => '2025-04-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => 'f1877a1f-d50e-4069-9f30-e2f76e567bed',
                'matricula_id' => '0ec23155-b327-4386-8895-df34c355c6e2',
                'concepto_id' => '7ed27e33-89db-47c4-bcba-aa75607d6b95',
                'pago_fecha' => '2025-05-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],

            // Pagos de matrícula_id: f4ff4f51-0303-4035-a865-9d7df3783e2d
            [
                'pago_id' => '1bd438ff-bd61-4dd9-a2ef-80f7df44a2c3',
                'matricula_id' => 'f4ff4f51-0303-4035-a865-9d7df3783e2d',
                'concepto_id' => 'aea675b1-045d-478e-8bd9-374398878bc0',
                'pago_fecha' => '2025-01-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => 'ce299230-bc94-49d0-81b7-83cbd8985fe7',
                'matricula_id' => 'f4ff4f51-0303-4035-a865-9d7df3783e2d',
                'concepto_id' => '5ffa9183-dbc5-4efa-94a9-b023ea3e706f',
                'pago_fecha' => '2025-02-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => 'd4fc7014-35a4-4fcd-bf4f-180b7a46c465',
                'matricula_id' => 'f4ff4f51-0303-4035-a865-9d7df3783e2d',
                'concepto_id' => '309bee77-bae4-4159-8bd9-45b14d6e7441',
                'pago_fecha' => '2025-03-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => 'f6dc58a4-bf32-44ff-bc87-13ffb4d683aa',
                'matricula_id' => 'f4ff4f51-0303-4035-a865-9d7df3783e2d',
                'concepto_id' => '9b9e58b1-88fc-46f0-8391-1ffb4abcca4c',
                'pago_fecha' => '2025-04-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
            [
                'pago_id' => '62f45083-7d76-42b6-b9d9-71d8dc39f909',
                'matricula_id' => 'f4ff4f51-0303-4035-a865-9d7df3783e2d',
                'concepto_id' => '7ed27e33-89db-47c4-bcba-aa75607d6b95',
                'pago_fecha' => '2025-05-10',
                'pago_valor' => 100000,
                'pago_estado' => 'pagado',
            ],
        ]);
    }
}
