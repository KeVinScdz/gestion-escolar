@extends('layouts.app')

@section('title', 'Reporte de Observaciones')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="w-full flex justify-between">
            <h1 class="text-3xl font-bold">Reporte de Observaciones</h1>
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
                <a href="/dashboard/observaciones" class="btn btn-error text-white bg-red-500 btn-sm">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </a>
                @endif
            </form>
        </div>

        <div class="w-full bg-base-200 border border-base-300 rounded-lg">
            <div class="w-full overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estudiante</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($observaciones as $observacion)
                        <tr>
                            <td>{{ explode("-", $observacion->observacion_id)[0] }}</td>
                            <td>
                                {{ $observacion->matricula->estudiante->usuario->usuario_nombre }} {{ $observacion->matricula->estudiante->usuario->usuario_apellido }}
                            </td>
                            <td>{{ $observacion->observacion_tipo }}</td>
                            <td>{{ Str::limit($observacion->observacion_descripcion, 100) }}</td> {{-- Limitar descripción para brevedad --}}
                            <td>{{ \Carbon\Carbon::parse($observacion->observacion_fecha)->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-5 text-center text-lg text-base-content/80">No hay observaciones registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $observaciones->links('components.pagination') }}
    </div>
</section>
@endsection