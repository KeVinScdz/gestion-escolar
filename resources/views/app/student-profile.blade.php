@extends('layouts.app')

@section('title', 'Información del Estudiante')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">Información del Estudiante</h1>

        <div class="w-full bg-base-200 border border-base-300 rounded-lg p-6 space-y-4">
            <!-- Información Básica -->
            <div class="flex items-center gap-4">
                <div class="avatar avatar-placeholder">
                    <div class="bg-neutral text-neutral-content w-14 rounded-full">
                        <span class="text-xl">
                            {{ $estudiante->usuario->usuario_nombre[0] }}{{ $estudiante->usuario->usuario_apellido[0] }}
                        </span>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold">{{ $estudiante->usuario->usuario_nombre }} {{ $estudiante->usuario->usuario_apellido }}</h2>
                    <p class="text-base-content/70">{{ $estudiante->usuario->usuario_correo }}</p>
                </div>
            </div>

            <!-- Información Personal -->
            <div class="divider my-5"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Documento:</span>
                        <span>{{ $estudiante->usuario->usuario_documento_tipo }}: {{ $estudiante->usuario->usuario_documento }}</span>
                    </div>
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Fecha de Nacimiento:</span>
                        <span>{{ \Carbon\Carbon::parse($estudiante->usuario->usuario_nacimiento)->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Dirección:</span>
                        <span>{{ $estudiante->usuario->usuario_direccion }}</span>
                    </div>
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Teléfono:</span>
                        <span>{{ $estudiante->usuario->usuario_telefono }}</span>
                    </div>
                </div>
            </div>

            <!-- Estado de Matrícula -->
            <div class="divider my-5"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Curso Actual:</span>
                        <span>{{ $estudiante->matriculas->first()->grupo->grupo_nombre ?? 'No matriculado' }}</span>
                    </div>
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Estado:</span>
                        <div class="badge {{ $estudiante->matriculas->isNotEmpty() ? 'badge-success' : 'badge-error' }}">
                            {{ $estudiante->matriculas->isNotEmpty() ? 'Matriculado' : 'No Matriculado' }}
                        </div>
                    </div>
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Periodo Academico Actual:</span>
                        <span>{{ $periodo->periodo_academico_nombre ?? 'No matriculado' }}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Promedio Académico:</span>
                        <span>{{ $promedio ?? 'No matriculado' }}</span>
                    </div>
                    <div class="flex gap-3 items-center">
                        <span class="font-medium">Total de Observaciones:</span>
                        <span>{{ $estudiante->matriculas->first()->observaciones->count() ?? 'No matriculado' }}</span>
                    </div>
                </div>
            </div>

            <!-- Tutor -->
            <div class="divider my-5"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex gap-3 items-center">
                    <span class="font-medium">Tutor:</span>
                    <span>{{ $estudiante->tutor->usuario->usuario_nombre ?? 'No tiene tutor' }} {{ $estudiante->tutor->usuario->usuario_apellido ?? '' }}</span>
                </div>
                <div class="flex gap-3 items-center">
                    <span class="font-medium">Correo:</span>
                    <span>{{ $estudiante->tutor->usuario->usuario_correo ?? 'No tiene tutor' }}</span>
                </div>
                <div class="flex gap-3 items-center">
                    <span class="font-medium">Teléfono:</span>
                    <span>{{ $estudiante->tutor->usuario->usuario_telefono ?? 'No tiene tutor' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection