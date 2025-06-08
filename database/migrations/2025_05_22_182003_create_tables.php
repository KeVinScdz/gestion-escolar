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
            $table->id('rol_id')->primary();
            $table->string('rol_nombre');
        });

        Schema::create('permisos', function (Blueprint $table) {
            $table->id('permiso_id')->primary();
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
            $table->uuid('estudiante_id')->primary();
            $table->uuid('institucion_id');
            $table->uuid('usuario_id');
            $table->timestamps();
        });

        Schema::create('tutores', function (Blueprint $table) {
            $table->uuid('tutor_id')->primary();
            $table->uuid('usuario_id');
            $table->uuid('estudiante_id');
        });

        Schema::create('docentes', function (Blueprint $table) {
            $table->uuid('docente_id')->primary();
            $table->uuid('usuario_id');
            $table->uuid('institucion_id');
            $table->string('docente_titulo');
            $table->timestamps();
        });

        Schema::create('administrativos', function (Blueprint $table) {
            $table->uuid('administrativo_id')->primary();
            $table->uuid('institucion_id');
            $table->uuid('usuario_id');
            $table->string('administrativo_cargo');
            $table->timestamps();
        });

        // Estructura academica
        Schema::create('instituciones', function (Blueprint $table) {
            $table->uuid('institucion_id')->primary();
            $table->string('institucion_nombre');
            $table->decimal('institucion_telefono', 10, 0)->unique();
            $table->string('institucion_correo')->unique();
            $table->string('institucion_direccion');
            $table->string('institucion_nit')->unique();
            $table->float('nota_minima');
            $table->float('nota_maxima');
            $table->float('nota_aprobatoria');
            $table->timestamps();
        });

        Schema::create('periodos_academicos', function (Blueprint $table) {
            $table->uuid('periodo_academico_id')->primary();
            $table->uuid('institucion_id');
            $table->string('periodo_academico_nombre');
            $table->integer('periodo_academico_año');
            $table->date('periodo_academico_inicio');
            $table->date('periodo_academico_fin');
        });

        Schema::create('niveles', function (Blueprint $table) {
            $table->id('nivel_id')->primary();
            $table->string('nivel_nombre');
        });

        Schema::create('grados', function (Blueprint $table) {
            $table->id('grado_id')->primary();
            $table->unsignedBigInteger('nivel_id');
            $table->string('grado_nombre');
        });

        Schema::create('grupos', function (Blueprint $table) {
            $table->uuid('grupo_id')->primary();
            $table->unsignedBigInteger('grado_id');
            $table->uuid('institucion_id');
            $table->string('grupo_nombre');
            $table->integer('grupo_cupo');
            $table->unsignedBigInteger('grupo_año');
            $table->timestamps();
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->uuid('materia_id')->primary();
            $table->string('materia_nombre');
            $table->uuid('institucion_id');
        });

        // Asignacion academica
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->uuid('asignacion_id');
            $table->uuid('docente_id');
            $table->uuid('materia_id');
            $table->uuid('grupo_id');
            $table->primary(['asignacion_id', 'materia_id', 'grupo_id']);
        });

        Schema::create('bloques', function (Blueprint $table) {
            $table->uuid('bloque_id')->primary();
            $table->uuid('institucion_id');
            $table->string('bloque_dia');
            $table->time('bloque_inicio');
            $table->time('bloque_fin');
        });

        Schema::create('horarios', function (Blueprint $table) {
            $table->uuid('horario_id')->primary();
            $table->uuid('bloque_id');
            $table->uuid('asignacion_id');
        });

        Schema::create('notas', function (Blueprint $table) {
            $table->uuid('nota_id')->primary();
            $table->uuid('matricula_id');
            $table->uuid('asignacion_id');
            $table->uuid('periodo_academico_id');
            $table->float('nota_valor');
        });

        // Matriculas
        Schema::create('matriculas', function (Blueprint $table) {
            $table->uuid('matricula_id');
            $table->uuid('estudiante_id');
            $table->uuid('grupo_id');
            $table->integer('matricula_año');
        });

        Schema::create('asistencias', function (Blueprint $table) {
            $table->uuid('asistencia_id');
            $table->uuid('matricula_id');
            $table->date('asistencia_fecha');
            $table->enum('asistencia_estado', ['presente', 'ausente', 'retardo']);
            $table->string('asistencia_motivo')->nullable();
            $table->primary(['asistencia_id', 'matricula_id', 'asistencia_fecha']);
        });

        Schema::create('solicitudes_matricula', function (Blueprint $table) {
            $table->uuid('solicitud_id')->primary();
            $table->uuid('institucion_id');
            $table->uuid('estudiante_id')->nullable();
            $table->uuid('grado_id');
            $table->integer('solicitud_año');
            $table->enum('solicitud_estado', ['pendiente', 'aprobada', 'rechazada'])->default('pendiente');
            $table->text('solicitud_comentario')->nullable();
            $table->timestamps();
        });

        Schema::create('solicitudes_tutores', function (Blueprint $table) {
            $table->uuid('solicitud_tutor_id')->primary();
            $table->uuid('solicitud_id');
            $table->string('tutor_nombre');
            $table->string('tutor_apellido');
            $table->enum('tutor_documento_tipo', ['CC', 'TI', 'CE']);
            $table->string('tutor_documento');
            $table->string('tutor_direccion');
            $table->decimal('tutor_telefono', 12, 0);
            $table->string('tutor_correo');
            $table->timestamps();
        });

        Schema::create('solicitudes_estudiantes', function (Blueprint $table) {
            $table->uuid('solicitud_estudiante_id')->primary();
            $table->uuid('solicitud_id');
            $table->string('estudiante_nombre');
            $table->string('estudiante_apellido');
            $table->enum('estudiante_documento_tipo', ['CC', 'TI', 'CE']);
            $table->string('estudiante_documento');
            $table->date('estudiante_nacimiento');
            $table->timestamps();
        });

        // Financiero
        Schema::create('conceptos_pago', function (Blueprint $table) {
            $table->uuid('concepto_id')->primary();
            $table->uuid('institucion_id');
            $table->string('concepto_nombre');
            $table->float('concepto_valor');
        });

        Schema::create('pagos', function (Blueprint $table) {
            $table->uuid('pago_id')->primary();
            $table->uuid('matricula_id');
            $table->uuid('concepto_id');
            $table->date('pago_fecha');
            $table->float('pago_valor');
            $table->string('pago_estado'); // pendiente, pagado, etc.
        });

        // Complementarias
        Schema::create('observaciones', function (Blueprint $table) {
            $table->uuid('observacion_id')->primary();
            $table->uuid('matricula_id');
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
        Schema::dropIfExists('bloques');

        // Matriculas
        Schema::dropIfExists('matriculas');
        Schema::dropIfExists('notas');
        Schema::dropIfExists('asistencias');
        Schema::dropIfExists('solicitudes_matricula');
        Schema::dropIfExists('solicitudes_tutores');
        Schema::dropIfExists('solicitudes_estudiantes');

        // Financiero
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('conceptos_pago');

        // Complementarias
        Schema::dropIfExists('observaciones');
    }
};
