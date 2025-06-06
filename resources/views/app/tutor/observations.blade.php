@extends('layouts.app')

@section('title', 'Observaciones del Estudiante')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">Observaciones del Estudiante</h1>

        <!-- Student Info Card -->
        <div class="bg-base-200 border border-base-300 p-5 rounded-lg">
            <div class="flex items-center gap-4">
                <div class="avatar avatar-placeholder">
                    <div class="bg-neutral text-neutral-content w-12 rounded-full">
                        <span class="text-xl">
                            {{ $usuarioSesion->tutor->estudiante->usuario->usuario_nombre[0] }}{{ $usuarioSesion->tutor->estudiante->usuario->usuario_apellido[0] }}
                        </span>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold">{{ $usuarioSesion->tutor->estudiante->usuario->usuario_nombre }} {{ $usuarioSesion->tutor->estudiante->usuario->usuario_apellido }}</h2>
                    <p class="text-sm text-gray-500">Documento: {{ $usuarioSesion->tutor->estudiante->usuario->usuario_documento }}</p>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="bg-base-200 border border-base-300 p-5 rounded-lg space-y-4">
            <h2 class="text-xl font-semibold">Resumen de Observaciones</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                $total = $observaciones->count();
                $ultimoMes = $observaciones->where('observacion_fecha', '>=', now()->subMonth())->count();
                @endphp
                <div class="stat bg-base-100 rounded-lg">
                    <div class="stat-title">Total Observaciones</div>
                    <div class="stat-value text-primary">{{ $total }}</div>
                    <div class="stat-desc">Registros en total</div>
                </div>
                <div class="stat bg-base-100 rounded-lg">
                    <div class="stat-title">Último Mes</div>
                    <div class="stat-value {{ $ultimoMes > 0 ? 'text-error' : 'text-success' }}">{{ $ultimoMes }}</div>
                    <div class="stat-desc">Observaciones en el último mes</div>
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
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($observaciones as $observacion)
                        <tr>
                            <td>{{ explode("-", $observacion->observacion_id)[0] }}</td>
                            <td>{{ $observacion->observacion_tipo }}</td>
                            <td>
                                <div class="tooltip tooltip-left" data-tip="{{ $observacion->observacion_descripcion }}">
                                    {{ Str::limit($observacion->observacion_descripcion, 100) }}
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($observacion->observacion_fecha)->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">No hay observaciones registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection 