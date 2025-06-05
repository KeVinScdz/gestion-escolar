@extends('layouts.app')

@section('title', $asignacion->materia->materia_nombre)

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">{{ $asignacion->materia->materia_nombre }}</h1>
        <div class="w-full bg-base-200 border border-base-300 p-5 rounded-lg space-y-2">
            <div class="flex items-center gap-2">
                <p class="font-bold">Grupo:</p>
                <p>{{ $asignacion->grupo->grupo_nombre }}</p>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-bold">Año:</p>
                <p>{{ $asignacion->grupo->grupo_año }}</p>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-bold">Docente:</p>
                <p>
                    {{ $asignacion->docente->usuario->usuario_nombre }} ({{ $asignacion->docente->usuario->usuario_correo }})
                </p>
            </div>
            <div class="space-y-2">
                <div class="font-bold p-0">
                    Horario
                </div>
                <div class="space-y-4 p-0 pl-4 border-l border-primary/50">
                    @forelse($asignacion->horarios as $horario)
                    <div>
                        <div class="w-24 text-sm font-medium">{{ $horario->bloque->bloque_dia }}</div>
                        <div>
                            {{ \Carbon\Carbon::parse($horario->bloque->bloque_inicio)->format('h:i A') }} -
                            {{ \Carbon\Carbon::parse($horario->bloque->bloque_fin)->format('h:i A') }}
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">No hay horarios registrados</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Grades -->
        <div class="bg-base-200 border border-base-300 p-5 rounded-lg space-y-2">
            <h2 class="text-xl font-semibold mb-4">Calificaciones</h2>
            <div class="w-full grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-4">
                @forelse($periodos as $periodo)
                <div class="w-full text-center">
                    <h3 class="font-medium mb-2">{{ $periodo->periodo_academico_nombre }}</h3>
                    @php
                    $nota = $periodo->notas->where('materia_id', $asignacion->materia_id)
                    ->where('matricula_id', $usuarioSesion->estudiante->matriculas->last()->matricula_id)
                    ->first();
                    @endphp
                    <div class="text-2xl font-bold {{ $nota ? 'text-primary' : 'text-base-content/50' }}">
                        {{ $nota ? number_format($nota->nota_valor, 1) : 'N/A' }}
                    </div>
                </div>
                @empty
                <p class="text-gray-500">No hay períodos académicos registrados</p>
                @endforelse
            </div>
        </div>

        <div class="bg-base-200 border border-base-300 rounded-lg p-5">
            <h2 class="text-xl font-semibold mb-4">Asistencia</h2>
            <div class="space-y-4">
                @forelse($asistencias as $asistencia)
                <div class="flex items-center justify-between">
                    <div class="text-gray-700">
                        {{ \Carbon\Carbon::parse($asistencia->asistencia_fecha)->format('d/m/Y') }}
                    </div>
                    <div class="px-3 py-1 rounded-full text-sm
                                {{ $asistencia->asistencia_estado === 'presente' ? 'bg-green-100 text-green-800' : 
                                   ($asistencia->asistencia_estado === 'retardo' ? 'bg-yellow-100 text-yellow-800' : 
                                    'bg-red-100 text-red-800') }}">
                        {{ ucfirst($asistencia->asistencia_estado) }}
                        {{ $asistencia->asistencia_motivo ? ' justificado: ' . $asistencia->asistencia_motivo : '' }}
                    </div>
                </div>
                @empty
                <p class="text-gray-500">No hay registros de asistencia</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection