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
                'usuario_documento' => '1012345678',
                'usuario_nacimiento' => '2006-05-12',
                'usuario_direccion' => 'Cra 10 #20-30, Bogotá',
                'usuario_telefono' => '3101234567',
                'usuario_contra' => Hash::make('12345678'),
                'rol_id' => 1,
                'created_at' => now(),
                'updated_at' => null,
            ]
        ]);

        DB::table('administrativos')->insert([
            [
                'usuario_id' => 'd436d563-a041-46ef-a951-1ca5ff0067ab',
                'administrativo_id' => 'ad9c4683-46ee-4ed6-96c6-5e3c9415919a',
                'administrativo_cargo' => 'Director TI',
            ]
        ]);

        DB::table('docentes')->insert([]);
        DB::table('estudiantes')->insert([]);
        DB::table('tutores')->insert([]);
    }
}
