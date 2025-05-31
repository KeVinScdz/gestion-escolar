@extends('layouts.app')

@section('title', 'Reporte de Asistencias')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="w-full flex justify-between">
            <h1 class="text-3xl font-bold">Reporte de Asistencias</h1>
            <form method="get" class="flex gap-2">
                <label class="input">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input type="search" name="search" placeholder="Buscar por alumno" value="{{ request('search') }}" />
                </label>
                @if(request('search'))
                <a href="/dashboard/inasistencias" class="btn btn-error text-white bg-red-500 btn-sm">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </a>
                @endif
            </form>
        </div>
        <div class="bg-base-200 border border-base-300 p-5 rounded-lg">
            <form method="GET" action="/dashboard/inasistencias" class="flex items-end space-x-3">
                <div>
                    <label for="justification_filter" class="block text-sm font-medium">Filtrar por Justificación:</label>
                    <select id="justification_filter" name="justification_filter" class="select select-bordered w-full max-w-xs mt-1">
                        <option value="">Todas</option>
                        <option value="justificada">Solo Justificadas</option>
                        <option value="injustificada">Solo Injustificadas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-neutral">Filtrar</button>
                @if($justificationFilter)
                <a href="/dashboard/inasistencias" class="btn btn-ghost">Limpiar Filtro</a>
                @endif
            </form>
        </div>

        <div class="w-full p-5 bg-base-200 border border-base-300">

            <div class="w-full overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Alumno</th>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Justificada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inasistencias as $inasistencia)
                        <tr>
                            <td class="border px-4 py-2">{{ $inasistencia->inastencia_id }}</td>
                            <td class="border px-4 py-2">{{ $inasistencia->matricula->estudiante->usuario->usuario_nombre }} {{ $inasistencia->matricula->estudiante->usuario->usuario_apellido }}</td>
                            <td class="border px-4 py-2">{{ $inasistencia->inasistencia_fecha }}</td>
                            <td class="border px-4 py-2">{{ $inasistencia->inasistencia_justificada ? 'Sí: ' . $inasistencia->inasistencia_motivo : 'No' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($inasistencias->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-500">No se encontraron registros de inasistencias.</p>
            </div>
            @endif
        </div>

        {{ $inasistencias->links('components.pagination') }}
    </div>
</section>
@endsection