<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Gestion usuarios
        Schema::create('roles', function (Blueprint $table) {
            $table->id('rol_id');
            $table->string('rol_nombre');
        });

        Schema::create('permisos', function (Blueprint $table) {
            $table->id('permiso_id');
            $table->string('permiso_nombre');
        });

        Schema::create('roles_permisos', function (Blueprint $table) {
            $table->id('rol_permiso_id');
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('permiso_id');
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('usuario_id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('rol_id');
            $table->string('usuario_correo')->unique();
            $table->string('usuario_contra');
            $table->timestamps();
        });

        // Perfil de usuarios
        Schema::create('personas', function (Blueprint $table) {
            $table->id('persona_id');
            $table->string('persona_nombre');
            $table->string('persona_apellido');
            $table->string('persona_documento')->unique();
            $table->date('persona_fecha_nacimiento');
            $table->string('persona_direccion');
            $table->string('persona_telefono');
            $table->timestamps();
        });

        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('estudiante_id');
            $table->unsignedBigInteger('persona_id');
            $table->string('estudiante_codigo');
        });

        Schema::create('docentes', function (Blueprint $table) {
            $table->id('docente_id');
            $table->unsignedBigInteger('persona_id');
            $table->string('docente_titulo');
        });

        Schema::create('administrativos', function (Blueprint $table) {
            $table->id('administrativo_id');
            $table->unsignedBigInteger('persona_id');
            $table->string('administrativo_cargo');
        });

        // Estructura academica
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id('institucion_id');
            $table->string('institucion_nombre');
            $table->string('institucion_direccion');
            $table->string('institucion_nit')->unique();
            $table->timestamps();
        });

        Schema::create('periodos_academicos', function (Blueprint $table) {
            $table->id('periodo_academico_id');
            $table->string('periodo_academico_nombre');
            $table->date('periodo_academico_inicio');
            $table->date('periodo_academico_fin');
        });

        Schema::create('niveles', function (Blueprint $table) {
            $table->id('nivel_id');
            $table->string('nivel_nombre');
        });

        Schema::create('grados', function (Blueprint $table) {
            $table->id('grado_id');
            $table->unsignedBigInteger('nivel_id');
            $table->string('grado_nombre');
        });

        Schema::create('grupos', function (Blueprint $table) {
            $table->id('grupo_id');
            $table->unsignedBigInteger('grado_id');
            $table->string('grupo_nombre');
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->id('materia_id');
            $table->string('materia_nombre');
        });

        // Asignacion academica
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('asignacion_id');
            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('grupo_id');
            $table->timestamps();
        });

        Schema::create('horarios', function (Blueprint $table) {
            $table->id('horario_id');
            $table->unsignedBigInteger('asignacion_id');
            $table->date('horario_dia');
            $table->time('horario_inicio');
            $table->time('horario_fin');
        });

        Schema::create('notas', function (Blueprint $table) {
            $table->id('nota_id');
            $table->unsignedBigInteger('matricula_id');
            $table->unsignedBigInteger('materia_id');
            $table->float('nota_valor');
            $table->timestamps();
        });

        // Matriculas
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('matricula_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('grupo_id');
            $table->unsignedBigInteger('periodo_academico_id');
            $table->timestamps();
        });

        Schema::create('inasistencias', function (Blueprint $table) {
            $table->id('inasistencia_id');
            $table->unsignedBigInteger('matricula_id');
            $table->date('inasistencia_fecha');
            $table->string('inasistencia_justificada')->nullable();
            $table->timestamps();
        });

        // Financiero
        Schema::create('conceptos_pago', function (Blueprint $table) {
            $table->id('concepto_pago_id');
            $table->string('concepto_pago_nombre');
            $table->float('concepto_pago_valor');
            $table->timestamps();
        });

        Schema::create('pagos', function (Blueprint $table) {
            $table->id('pago_id');
            $table->unsignedBigInteger('matricula_id');
            $table->unsignedBigInteger('concepto_pago_id');
            $table->date('pago_fecha');
            $table->float('pago_valor');
            $table->string('pago_estado'); // pendiente, pagado, etc.
            $table->timestamps();
        });

        // Complementarias
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id('observacion_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->string('observacion_tipo');
            $table->text('observacion_descripcion');
            $table->date('observacion_fecha');
            $table->timestamps();
        });

        Schema::create('logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('log_accion');
            $table->text('log_descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Gestion usuarios
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permisos');
        Schema::dropIfExists('roles_permisos');

        // Perfil de usuarios
        Schema::dropIfExists('personas');
        Schema::dropIfExists('estudiantes');
        Schema::dropIfExists('docentes');
        Schema::dropIfExists('administrativos');

        // Estructura academica
        Schema::dropIfExists('instituciones');
        Schema::dropIfExists('periodos_academicos');
        Schema::dropIfExists('niveles');
        Schema::dropIfExists('grados');
        Schema::dropIfExists('grupos');
        Schema::dropIfExists('materias');

        // Asignacion academica
        Schema::dropIfExists('asignaciones');
        Schema::dropIfExists('horarios');

        // Matriculas
        Schema::dropIfExists('matriculas');
        Schema::dropIfExists('notas');
        Schema::dropIfExists('inasistencias');

        // Financiero
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('conceptos_pago');

        // Complementarias
        Schema::dropIfExists('observaciones');
        Schema::dropIfExists('logs');
    }
};
