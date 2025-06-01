@extends('layouts.app')

@section('title', 'Gestión Periodos Académicos')

@section('content')

<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="flex flex-col md:flex-row gap-5 justify-between items-center">
            <h1 class="text-3xl font-semibold">Gestión de Periodos Académicos</h1>
            {{-- Botón para abrir modal de creación, necesitarás crear este modal --}}
            <button class="btn btn-primary" onclick="document.getElementById('create_period_modal').show()">Crear Nuevo Periodo</button>
        </div>

        {{-- Filtro por Año --}}
        <div class="bg-base-200 border border-base-300 p-5 rounded-lg">
            <form method="GET" action="/dashboard/periodos" class="flex items-end space-x-3">
                <div>
                    <label for="year_filter" class="block text-sm font-medium">Filtrar por Año:</label>
                    <select id="year_filter" name="year_filter" class="select select-bordered w-full max-w-xs mt-1">
                        <option value="">Todos los años</option>
                        @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-neutral">Filtrar</button>
                @if($selectedYear)
                <a href="/dashboard/periodos" class="btn btn-ghost">Limpiar Filtro</a>
                @endif
            </form>
        </div>

        {{-- Tabla de Periodos Académicos --}}
        <div class="overflow-x-auto bg-base-200 border border-base-300 rounded-lg">
            @if($periodos->count() > 0)
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Nombre del Periodo</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periodos as $periodo)
                    <tr>
                        <td>{{ $periodo->periodo_academico_nombre }}</td>
                        <td>{{ \Carbon\Carbon::parse($periodo->periodo_academico_inicio)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($periodo->periodo_academico_fin)->format('d/m/Y') }}</td>
                        <td>
                            <div class="flex flex-wrap gap-2">
                                <button class="btn btn-sm py-1 btn-primary" onclick="openEditModal('{{ $periodo->periodo_academico_id }}', '{{ json_encode($periodo) }}')">Editar</button>
                                <button class="btn btn-sm py-1 btn-error" onclick="deletePeriod('{{ $periodo->periodo_academico_id }}')">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-center text-base-content/60 py-5">No se encontraron periodos académicos.</p>
            @if($selectedYear)
            <p class="text-center text-base-content/60">Intenta con otro año o <a href="/dashboard/periodos" class="link">limpia el filtro</a>.</p>
            @endif
            @endif
        </div>

        {{ $periodos->links('components.pagination') }}
    </div>
</section>

<!-- Create period modal -->
<dialog id="create_period_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Crear Nuevo Periodo Académico</h3>
        <form data-target="/api/periods" data-method="post" data-show-alert="true" data-reload="true" class="upload-form py-4 space-y-3">
            <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}">

            <fieldset class="w-full fieldset">
                <label for="periodo_academico_nombre" class="fieldset-label">
                    Nombre del Periodo:
                </label>
                <input type="text" id="periodo_academico_nombre" name="periodo_academico_nombre" class="input input-bordered">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label for="periodo_academico_año" class="fieldset-label">
                    Año:
                </label>
                <input type="number" id="periodo_academico_año" name="periodo_academico_año" class="input input-bordered">
            </fieldset>
            </fieldset>
            <fieldset class="w-full fieldset">
                <label for="periodo_academico_inicio" class="fieldset-label">
                    Fecha de Inicio:
                </label>
                <input type="date" id="periodo_academico_inicio" name="periodo_academico_inicio" class="input input-bordered">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label for="periodo_academico_fin" class="fieldset-label">
                    Fecha de Fin:
                </label>
                <input type="date" id="periodo_academico_fin" name="periodo_academico_fin" class="input input-bordered">
            </fieldset>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn" onclick="document.getElementById('create_period_modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Update period modal -->
<dialog id="update-period-modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Actualizar Periodo Académico</h3>
        <form data-target="/api/periods/{id}" data-method="put" data-show-alert="true" data-reload="true" class="upload-form py-4 space-y-3">
            <fieldset class="w-full fieldset">
                <label for="update_periodo_academico_nombre" class="fieldset-label">
                    Nombre del Periodo:
                </label>
                <input type="text" id="update_periodo_academico_nombre" name="periodo_academico_nombre" class="input input-bordered">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label for="update_periodo_academico_año" class="fieldset-label">
                    Año:
                </label>
                <input type="number" id="update_periodo_academico_año" name="periodo_academico_año" class="input input-bordered">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label for="update_periodo_academico_inicio" class="fieldset-label">
                    Fecha de Inicio:
                </label>
                <input type="date" id="update_periodo_academico_inicio" name="periodo_academico_inicio" class="input input-bordered">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label for="update_periodo_academico_fin" class="fieldset-label">
                    Fecha de Fin:
                </label>
                <input type="date" id="update_periodo_academico_fin" name="periodo_academico_fin" class="input input-bordered">
            </fieldset>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn" onclick="document.getElementById('update-period-modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Delete period form -->
<form id="delete-period-form" data-target="/api/periods/{id}" data-method="delete" data-reload="true" data-show-alert="true" class="upload-form hidden">
    <button type="submit">Eliminar</button>
</form>

<script>
    function openEditModal(periodoId, periodoJSONString) {
        var periodo = JSON.parse(periodoJSONString);
        $modal = document.getElementById('update-period-modal');

        // Set the form action URL
        $modal.querySelector('form').setAttribute('data-target', '/api/periods/' + periodoId);

        // Set the input values
        $modal.querySelector('#update_periodo_academico_nombre').value = periodo.periodo_academico_nombre;
        $modal.querySelector('#update_periodo_academico_año').value = periodo.periodo_academico_año;
        $modal.querySelector('#update_periodo_academico_inicio').value = periodo.periodo_academico_inicio;
        $modal.querySelector('#update_periodo_academico_fin').value = periodo.periodo_academico_fin;

        $modal.show();
    }

    function deletePeriod(periodoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (!result.isConfirmed) return;
            var $form = document.getElementById('delete-period-form');
            $form.setAttribute('data-target', '/api/periods/' + periodoId);

            $form.querySelector('button').click();
        });
    }
</script>

@endsection