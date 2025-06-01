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

        <div class="w-full bg-base-200 border border-base-300 rounded-lg">
            <div class="w-full overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>Fecha</th>
                            <th>Justificada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inasistencias as $inasistencia)
                        <tr>
                            <td>{{ $inasistencia->inasistencia_id }}</td>
                            <td>{{ $inasistencia->matricula->estudiante->usuario->usuario_nombre }} {{ $inasistencia->matricula->estudiante->usuario->usuario_apellido }}</td>
                            <td>{{ $inasistencia->inasistencia_fecha }}</td>
                            <td>{{ $inasistencia->inasistencia_justificada ? 'Sí: ' . $inasistencia->inasistencia_motivo : 'No' }}</td>
                            <td>
                                <button
                                    onclick="openEditAbsenceModal('{{ $inasistencia->inasistencia_id }}', '{{ json_encode($inasistencia) }}')"
                                    class="btn btn-sm py-1 btn-primary">
                                    Editar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($inasistencias->isEmpty())
            <div class="text-center py-10">
                <p class="text-base-content/80">No se encontraron registros de inasistencias.</p>
            </div>
            @endif
        </div>

        {{ $inasistencias->links('components.pagination') }}
    </div>
</section>

<!-- Edit Absence Modal -->
<dialog id="edit-absence-modal" class="modal">
    <div class="modal-box">
        <h2 class="text-2xl font-bold mb-4">Editar Inasistencia</h2>
        <form class="upload-form space-y-4" data-target="/api/absences/{id}" data-method="put" data-reload="true" data-show-alert="true">
            <fieldset class="fieldset">
                <label for="edit_inasistencia_fecha" class="fieldset-label">
                    Fecha de la Inasistencia:
                </label>
                <input type="date" name="inasistencia_fecha" id="edit_inasistencia_fecha" class="input input-bordered">
            </fieldset>
            <fieldset class="fieldset">
                <label for="edit_inasistencia_justificada" class="fieldset-label">
                    Estado de la Inasistencia:
                </label>
                <select name="inasistencia_justificada" id="edit_inasistencia_justificada" class="select select-bordered">
                    <option value="1">Justificada</option>
                    <option value="0">Injustificada</option>
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <label for="edit_inasistencia_motivo" class="fieldset-label">
                    Motivo de la Inasistencia (opcional):
                </label>
                <textarea name="inasistencia_motivo" id="edit_inasistencia_motivo" class="textarea textarea-bordered"></textarea>
            </fieldset>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@endsection

@section('scripts')
<script>
    function openEditAbsenceModal(id, inasistenciaJSONString) {
        const inasistencia = JSON.parse(inasistenciaJSONString);

        const $form = document.querySelector('#edit-absence-modal form');
        $form.dataset.target = "/api/absences/" + id;

        document.getElementById('edit_inasistencia_justificada').value = inasistencia.inasistencia_justificada ? '1' : '0';
        document.getElementById('edit_inasistencia_motivo').value = inasistencia.inasistencia_motivo || '';
        document.getElementById('edit_inasistencia_fecha').value = inasistencia.inasistencia_fecha;

        const $modal = document.getElementById('edit-absence-modal');
        $modal.show();
    }
</script>
@endsection