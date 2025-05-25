@extends('layouts.app')

@section('title', 'Instituciones')

@section('content')
<div class="container mx-auto px-4 py-6 space-y-5">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 flex-1">Instituciones Registradas</h1>
        <div class="flex items-center gap-2 flex-1">
            <form method="get">
                <label class="input">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input type="search" name="search" placeholder="Search" />
                </label>
            </form>
            <a href="/dashboard/instituciones/nueva" class="btn btn-primary">
                + Nueva Institución
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto rounded bg-base-200 border border-base-300">
        <table class="min-w-full text-sm text-base-content">
            <thead class="bg-bsae-300 border-b border-base-300">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Nombre</th>
                    <th class="px-6 py-3 text-left font-semibold">NIT</th>
                    <th class="px-6 py-3 text-left font-semibold">Dirección</th>
                    <th class="px-6 py-3 text-left font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($instituciones as $institucion)
                <tr>
                    <td class="px-6 py-4">{{ $institucion->institucion_nombre }}</td>
                    <td class="px-6 py-4">{{ $institucion->institucion_nit }}</td>
                    <td class="px-6 py-4">{{ $institucion->institucion_direccion }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="/dashboard/instituciones/editar/{{ $institucion -> institucion_id }}" class="btn btn-sm py-1 btn-primary">
                            Editar
                        </a>
                        <form data-target="institutions/{{ $institucion -> institucion_id }}" data-method="delete">
                            <button type="submit" class="btn btn-sm py-1 btn-error">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4 text-gray-500">
                        No hay instituciones registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $instituciones->links('components.pagination') }}
</div>
@endsection