@extends('layouts.app')

@section('title', 'Notas del Estudiante')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Notas Académicas</h1>
            <div class="flex gap-4">
                <a href="/dashboard/tutor/notas/export" class="btn btn-primary">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                </a>
            </div>
        </div>

        <!-- Información del Estudiante -->
        <div class="bg-base-200 border border-base-300 rounded-lg shadow p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Información del Estudiante</h2>
                    <p><span class="font-medium">Nombre:</span> {{ $usuarioSesion->tutor->estudiante->usuario->usuario_nombre }} {{ $usuarioSesion->tutor->estudiante->usuario->usuario_apellido }}</p>
                    <p><span class="font-medium">Documento:</span> {{ $usuarioSesion->tutor->estudiante->usuario->usuario_documento }}</p>
                    <p><span class="font-medium">Institución:</span> {{ $institucion->institucion_nombre }}</p>
                    <p><span class="font-medium">Curso:</span> {{ $usuarioSesion->tutor->estudiante->matriculas->first()->grupo->grupo_nombre }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-4">Promedio General</h2>
                    <div 
                    class="text-4xl font-bold tooltip cursor-pointer {{ $notas->avg('nota_valor') >= $institucion->nota_aprobatoria ? 'text-green-600' : 'text-red-600' }}"
                    data-tip="
                    @if($notas->avg('nota_valor') >= $institucion->nota_aprobatoria)
                    Promedio aprobado (≥ {{ $institucion->nota_aprobatoria }})
                    @else
                    Promedio reprobado (< {{ $institucion->nota_aprobatoria }})
                    @endif
                    ">
                        {{ number_format($notas->avg('nota_valor'), 1) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Notas -->
        <div class="bg-base-200 border border-base-300 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-base-300">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Asignatura</th>
                            @foreach($periodos as $periodo)
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    {{ $periodo->periodo_academico_nombre }}
                                </th>
                            @endforeach
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Promedio</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($asignaciones as $asignacion)
                            @php
                                $asignacionNotas = $notas->where('asignacion_id', $asignacion->asignacion_id);
                                $promedio = $asignacionNotas->avg('nota_valor');
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    {{ $asignacion->materia->materia_nombre }}
                                    </td>
                                    @foreach($periodos as $periodo)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $asignacionNotas->where('periodo_academico_id', $periodo->periodo_academico_id)->first()->nota_valor ?? '-' }}
                                        </td>
                                    @endforeach
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ isset($promedio) ? $promedio >= $institucion->nota_aprobatoria ? 'text-green-600' : 'text-red-600' : '' }}">
                                    {{ $promedio ? number_format($promedio, 1) : 'N/A' }}
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="{{ count($periodos) + 2 }}" class="text-center px-6 py-4">
                                No hay asignaciones
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection