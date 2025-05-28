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

        Schema::create('administrativos_permisos', function (Blueprint $table) {
            $table->uuid('administrativo_id');
            $table->unsignedBigInteger('permiso_id');
            $table->primary(['administrativo_id', 'permiso_id']);
        });

        // Perfil de usuarios
        Schema::create('usuarios', function (Blueprint $table) {
            $table->uuid('usuario_id')->primary();
            $table->string('usuario_nombre');
            $table->string('usuario_apellido');
            $table->string('usuario_correo')->unique();
            $table->enum('usuario_documento_tipo', ['CC', 'TI', 'CE']);
            $table->string('usuario_documento')->unique();
            $table->date('usuario_nacimiento');
            $table->string('usuario_direccion');
            $table->decimal('usuario_telefono', 12, 0);
            $table->string('usuario_contra');
            $table->unsignedBigInteger('rol_id');
            $table->timestamps();
        });

        Schema::create('estudiantes', function (Blueprint $table) {
            $table->uuid('estudiante_id');
            $table->uuid('institucion_id');
            $table->uuid('usuario_id');
        });

        Schema::create('tutores', function (Blueprint $table) {
            $table->uuid('tutor_id');
            $table->uuid('usuario_id');
            $table->uuid('estudiante_id');
        });

        Schema::create('docentes', function (Blueprint $table) {
            $table->uuid('docente_id');
            $table->uuid('usuario_id');
            $table->uuid('institucion_id');
            $table->string('docente_titulo');
        });

        Schema::create('administrativos', function (Blueprint $table) {
            $table->uuid('administrativo_id');
            $table->uuid('institucion_id');
            $table->uuid('usuario_id');
            $table->string('administrativo_cargo');
        });

        // Estructura academica
        Schema::create('instituciones', function (Blueprint $table) {
            $table->uuid('institucion_id');
            $table->string('institucion_nombre');
            $table->decimal('institucion_telefono', 10, 0)->unique();
            $table->string('institucion_correo')->unique();
            $table->string('institucion_direccion');
            $table->string('institucion_nit')->unique();
            $table->timestamps();
        });

        Schema::create('periodos_academicos', function (Blueprint $table) {
            $table->uuid('periodo_academico_id');
            $table->uuid('institucion_id');
            $table->string('periodo_academico_nombre');
            $table->integer('periodo_academico_año');
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
            $table->uuid('grupo_id');
            $table->unsignedBigInteger('grado_id');
            $table->uuid('institucion_id');
            $table->string('grupo_nombre');
            $table->unsignedBigInteger('grupo_año');
            $table->timestamps();
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->id('materia_id');
            $table->string('materia_nombre');
            $table->uuid('institucion_id');
        });

        // Asignacion academica
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->uuid('asignacion_id');
            $table->uuid('docente_id');
            $table->unsignedBigInteger('materia_id');
            $table->uuid('grupo_id');
            $table->timestamps();
        });

        Schema::create('horarios', function (Blueprint $table) {
            $table->uuid('horario_id');
            $table->uuid('asignacion_id');
            $table->date('horario_dia');
            $table->time('horario_inicio');
            $table->time('horario_fin');
        });

        Schema::create('notas', function (Blueprint $table) {
            $table->uuid('nota_id');
            $table->uuid('estudiante_id');
            $table->uuid('asignacion_id');
            $table->float('nota_valor');
            $table->timestamps();
        });

        // Matriculas
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('matricula_id');
            $table->uuid('estudiante_id');
            $table->uuid('grupo_id');
            $table->integer('matricula_año');
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
        Schema::dropIfExists('administrativos_permisos');

        // Perfil de usuarios
        Schema::dropIfExists('estudiantes');
        Schema::dropIfExists('tutores');
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
    }
};
