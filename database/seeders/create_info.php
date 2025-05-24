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
            [
                'rol_id' => 1,
                'rol_nombre' => 'ADMINISTRADOR',
                'created_at' => '2024-01-03 16:20:20',
                'updated_at' => null,
            ],
            [
                'rol_id' => 2,
                'rol_nombre' => 'DIRECTOR ACADÉMICO',
                'created_at' => '2024-01-03 16:20:20',
                'updated_at' => null,
            ],
            [
                'rol_id' => 3,
                'rol_nombre' => 'DIRECTOR ADMINISTRATIVO',
                'created_at' => '2024-01-03 16:20:20',
                'updated_at' => null,
            ],
            [
                'rol_id' => 4,
                'rol_nombre' => 'CONTADOR',
                'created_at' => '2024-01-03 16:20:20',
                'updated_at' => null,
            ],
            [
                'rol_id' => 5,
                'rol_nombre' => 'SECRETARIA',
                'created_at' => '2024-01-03 16:20:20',
                'updated_at' => null,
            ],
            [
                'rol_id' => 6,
                'rol_nombre' => 'DOCENTE',
                'created_at' => '2024-01-03 16:20:20',
                'updated_at' => null,
            ],
            [
                'rol_id' => 7,
                'rol_nombre' => 'ESTUDIANTE',
                'created_at' => '2025-04-11 13:48:48',
                'updated_at' => null,
            ],
        ]);

        DB::table('personas')->insert([
            [
                'persona_id' => 1,
                'persona_nombre' => 'Kevin',
                'persona_apellido' => 'García',
                'persona_documento' => '1012345678',
                'persona_fecha_nacimiento' => '1990-05-12',
                'persona_direccion' => 'Cra 10 #20-30, Bogotá',
                'persona_telefono' => '3101234567',
                'created_at' => '2023-12-28 20:29:10',
                'updated_at' => null,
            ],
            [
                'persona_id' => 3,
                'persona_nombre' => 'Luna',
                'persona_apellido' => 'Martínez',
                'persona_documento' => '1012345679',
                'persona_fecha_nacimiento' => '1985-08-22',
                'persona_direccion' => 'Cll 45 #15-60, Bogotá',
                'persona_telefono' => '3112345678',
                'created_at' => '2025-04-08 02:26:57',
                'updated_at' => null,
            ],
            [
                'persona_id' => 4,
                'persona_nombre' => 'Cesar',
                'persona_apellido' => 'Ramírez',
                'persona_documento' => '1012345680',
                'persona_fecha_nacimiento' => '1992-11-03',
                'persona_direccion' => 'Av 68 #80-55, Bogotá',
                'persona_telefono' => '3123456789',
                'created_at' => '2025-04-08 02:29:47',
                'updated_at' => '2025-04-12 03:18:01',
            ],
            [
                'persona_id' => 5,
                'persona_nombre' => 'Mariana',
                'persona_apellido' => 'López',
                'persona_documento' => '1012345681',
                'persona_fecha_nacimiento' => '1998-03-15',
                'persona_direccion' => 'Cll 100 #50-20, Bogotá',
                'persona_telefono' => '3134567890',
                'created_at' => '2025-04-08 02:31:34',
                'updated_at' => '2025-04-08 03:59:12',
            ],
            [
                'persona_id' => 6,
                'persona_nombre' => 'Daniel',
                'persona_apellido' => 'Moreno',
                'persona_documento' => '1012345682',
                'persona_fecha_nacimiento' => '2001-07-09',
                'persona_direccion' => 'Cra 7 #72-15, Bogotá',
                'persona_telefono' => '3145678901',
                'created_at' => '2025-04-08 02:34:35',
                'updated_at' => '2025-04-09 02:26:11',
            ],
            [
                'persona_id' => 7,
                'persona_nombre' => 'Camila',
                'persona_apellido' => 'Vargas',
                'persona_documento' => '1012345683',
                'persona_fecha_nacimiento' => '1995-12-30',
                'persona_direccion' => 'Cll 26 #30-40, Bogotá',
                'persona_telefono' => '3156789012',
                'created_at' => '2025-04-09 02:29:15',
                'updated_at' => null,
            ],
            [
                'persona_id' => 8,
                'persona_nombre' => 'Juana',
                'persona_apellido' => 'Castro',
                'persona_documento' => '1012345684',
                'persona_fecha_nacimiento' => '2002-02-18',
                'persona_direccion' => 'Av Suba #120-10, Bogotá',
                'persona_telefono' => '3167890123',
                'created_at' => '2025-04-11 05:03:52',
                'updated_at' => null,
            ],
            [
                'persona_id' => 9,
                'persona_nombre' => 'Pablo',
                'persona_apellido' => 'Jiménez',
                'persona_documento' => '1012345685',
                'persona_fecha_nacimiento' => '1993-09-25',
                'persona_direccion' => 'Cra 15 #80-20, Bogotá',
                'persona_telefono' => '3178901234',
                'created_at' => '2025-04-11 12:52:37',
                'updated_at' => null,
            ],
            [
                'persona_id' => 11,
                'persona_nombre' => 'Ana',
                'persona_apellido' => 'Ruiz',
                'persona_documento' => '1012345686',
                'persona_fecha_nacimiento' => '1997-06-14',
                'persona_direccion' => 'Cll 80 #100-30, Bogotá',
                'persona_telefono' => '3189012345',
                'created_at' => '2025-04-11 19:19:40',
                'updated_at' => null,
            ],
        ]);

        DB::table('usuarios')->insert([
            [
                'usuario_id' => 1,
                'persona_id' => 1,
                'rol_id' => 1,
                'usuario_correo' => 'kevin@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2023-12-28 20:29:10',
                'updated_at' => null,
            ],
            [
                'usuario_id' => 3,
                'persona_id' => 3,
                'rol_id' => 6,
                'usuario_correo' => 'luna@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-08 02:26:57',
                'updated_at' => null,
            ],
            [
                'usuario_id' => 4,
                'persona_id' => 4,
                'rol_id' => 6,
                'usuario_correo' => 'cesar@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-08 02:29:47',
                'updated_at' => '2025-04-12 03:18:01',
            ],
            [
                'usuario_id' => 5,
                'persona_id' => 5,
                'rol_id' => 7,
                'usuario_correo' => 'mariana@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-08 02:31:34',
                'updated_at' => '2025-04-08 03:59:12',
            ],
            [
                'usuario_id' => 6,
                'persona_id' => 6,
                'rol_id' => 7,
                'usuario_correo' => 'daniel@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-08 02:34:35',
                'updated_at' => '2025-04-09 02:26:11',
            ],
            [
                'usuario_id' => 7,
                'persona_id' => 7,
                'rol_id' => 7,
                'usuario_correo' => 'camila@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-09 02:29:15',
                'updated_at' => null,
            ],
            [
                'usuario_id' => 8,
                'persona_id' => 8,
                'rol_id' => 7,
                'usuario_correo' => 'juana@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-11 05:03:52',
                'updated_at' => null,
            ],
            [
                'usuario_id' => 9,
                'persona_id' => 9,
                'rol_id' => 6,
                'usuario_correo' => 'pablo@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-11 12:52:37',
                'updated_at' => null,
            ],
            [
                'usuario_id' => 11,
                'persona_id' => 11,
                'rol_id' => 6,
                'usuario_correo' => 'ana@gmail.com',
                'usuario_contraseña' => Hash::make('12345678'),
                'created_at' => '2025-04-11 19:19:40',
                'updated_at' => null,
            ],
        ]);
    }
}
