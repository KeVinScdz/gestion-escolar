@extends('layouts.app')

@section('title', 'Asistencias')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">Asistencias</h1>

        <!-- Summary Card -->
        <div class="bg-base-200 border border-base-300 p-5 rounded-lg space-y-4">
            <h2 class="text-xl font-semibold">Resumen de Asistencias</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $total = $asistencias->count();
                    $presentes = $asistencias->where('asistencia_estado', 'presente')->count();
                    $retardos = $asistencias->where('asistencia_estado', 'retardo')->count();
                    $ausentes = $asistencias->where('asistencia_estado', 'ausente')->count();
                    $porcentajeAsistencia = $total > 0 ? round(($presentes / $total) * 100, 1) : 0;
                @endphp
                <div class="stat bg-base-100 rounded-lg">
                    <div class="stat-title">Asistencia Total</div>
                    <div class="stat-value text-primary">{{ $porcentajeAsistencia }}%</div>
                    <div class="stat-desc">{{ $presentes }} de {{ $total }} clases</div>
                </div>
                <div class="stat bg-base-100 rounded-lg">
                    <div class="stat-title">Retardos</div>
                    <div class="stat-value text-warning">{{ $retardos }}</div>
                    <div class="stat-desc">Clases con retardo</div>
                </div>
                <div class="stat bg-base-100 rounded-lg">
                    <div class="stat-title">Ausencias</div>
                    <div class="stat-value text-error">{{ $ausentes }}</div>
                    <div class="stat-desc">Clases ausentes</div>
                </div>
            </div>
        </div>

        <!-- Detailed Records -->
        <div class="bg-base-200 border border-base-300 rounded-lg p-5">
            <h2 class="text-xl font-semibold mb-4">Registro Detallado</h2>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asistencias as $asistencia)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($asistencia->asistencia_fecha)->format('d/m/Y') }}</td>
                            <td>
                                <div class="badge {{ $asistencia->asistencia_estado === 'presente' ? 'badge-success' : 
                                    ($asistencia->asistencia_estado === 'retardo' ? 'badge-warning' : 'badge-error') }}">
                                    {{ ucfirst($asistencia->asistencia_estado) }}
                                </div>
                            </td>
                            <td>
                                @if($asistencia->asistencia_motivo)
                                    <div>
                                        <i class="fas fa-info-circle"></i>
                                        {{ $asistencia->asistencia_motivo }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500">No hay registros de asistencia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection