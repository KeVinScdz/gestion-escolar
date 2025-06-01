@extends('layouts.app')

@section('title', 'Gestión administrativos')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Gestión Grupos</h1>
            <button class="btn btn-primary" onclick="document.getElementById('create_group_modal').show()">Crear Nuevo Grupo</button>
        </div>

        {{-- Filtro por Año --}}
        <div class="bg-base-200 border border-base-300 p-5 rounded-lg">
            <form method="GET" action="/dashboard/cursos" class="flex items-end space-x-3">
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
                <a href="/dashboard/cursos" class="btn btn-ghost">Limpiar Filtro</a>
                @endif
            </form>
        </div>

        @if($grupos->count() > 0)
        <div class="overflow-x-auto bg-base-200 border border-base-300 rounded-lg">
            <table class="table w-full min-w-[900px]">
                <thead>
                    <tr>
                        <th>Nombre del Grupo</th>
                        <th>Grado</th>
                        <th>Año del Periodo</th>
                        <th>Cupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->grupo_nombre }}</td>
                        <td>{{ $grupo->grado->grado_nombre ?? 'N/A' }}</td> {{-- Asumiendo que tienes la relación 'grado' y 'grado_nombre' en el modelo Grado --}}
                        <td>{{ $grupo->grupo_año }}</td>
                        <td>{{ $grupo->grupo_cupo }}</td>
                        <td>
                            <div class="flex flex-wrap gap-2">
                                <button class="btn btn-sm py-1 btn-primary" onclick="openEditGroupModal('{{ $grupo->grupo_id }}', '{{ json_encode($grupo) }}')">Editar</button>
                                <button class="btn btn-sm py-1 btn-error" onclick="confirmDeleteGroup('{{ $grupo->grupo_id }}')">Eliminar</button>
                                <button class="btn btn-sm py-1 btn-primary btn-outline" onclick="openAssignSubjectsModal('{{ $grupo->grupo_id,  }}', '{{ json_encode($grupo) }}')">Asignar Materias</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $grupos->links('components.pagination') }}
        @else
        <p>No hay grupos registrados.</p>
        @endif
    </div>
</section>

{{-- Modal Crear Grupo --}}
<dialog id="create_group_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Crear Nuevo Grupo</h3>
        <form data-target="/api/groups" data-method="post" data-show-alert="true" data-reload="true" class="upload-form py-4 space-y-3">
            <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}">

            <fieldset class="w-full fieldset">
                <label for="create_grupo_nombre" class="fieldset-label">Nombre del Grupo:</label>
                <input type="text" id="create_grupo_nombre" name="grupo_nombre" class="input input-bordered w-full">
            </fieldset>

            <fieldset class="w-full fieldset">
                <label for="create_grado_id" class="fieldset-label">Grado:</label>
                <select id="create_grado_id" name="grado_id" class="select select-bordered w-full">
                    @foreach($grados as $grado)
                    <option value="{{ $grado->grado_id }}">{{ $grado->grado_nombre }}</option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="w-full fieldset">
                <label for="create_grupo_cupo" class="fieldset-label">Cupo:</label>
                <input type="number" id="create_grupo_cupo" name="grupo_cupo" class="input input-bordered w-full">
            </fieldset>

            <fieldset class="w-full fieldset">
                <label for="create_grupo_año" class="fieldset-label">Año del Grupo (Ej: 2025):</label>
                <input type="number" id="create_grupo_año" name="grupo_año" class="input input-bordered w-full" placeholder="{{ date('Y') }}">
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn" onclick="document.getElementById('create_group_modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

{{-- Modal Editar Grupo --}}
<dialog id="edit-group-modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Editar Grupo</h3>
        <form data-target="/api/groups/" data-method="put" data-show-alert="true" data-reload="true" class="upload-form py-4 space-y-3">
            <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}">

            <fieldset class="w-full fieldset">
                <label for="edit_grupo_nombre" class="fieldset-label">Nombre del Grupo:</label>
                <input type="text" id="edit_grupo_nombre" name="grupo_nombre" class="input input-bordered w-full">
            </fieldset>

            <fieldset class="w-full fieldset">
                <label for="edit_grado_id" class="fieldset-label">Grado:</label>
                <select id="edit_grado_id" name="grado_id" class="select select-bordered w-full">
                    @foreach($grados as $grado)
                    <option value="{{ $grado->grado_id }}">{{ $grado->grado_nombre }}</option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="w-full fieldset">
                <label for="edit_grupo_cupo" class="fieldset-label">Cupo:</label>
                <input type="number" id="edit_grupo_cupo" name="grupo_cupo" class="input input-bordered w-full">
            </fieldset>

            <fieldset class="w-full fieldset">
                <label for="edit_grupo_año" class="fieldset-label">Año del Grupo (Ej: 2024):</label>
                <input type="number" id="edit_grupo_año" name="grupo_año" class="input input-bordered w-full">
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn" onclick="document.getElementById('edit-group-modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<form id="delete-group-form" class="upload-form hidden" data-target="/api/groups/{id}" data-method="delete" data-reload="true" data-show-alert="true">
    <button type="submit">Eliminar</button>
</form>

<!-- Assing Subjects Modal -->
<dialog id="assing-subjects-modal" class="modal" data-method="put" data-debug="true" data-reload="true">
    <div class="modal-box max-w-2xl">
        <h3 class="font-bold text-xl mb-4">Asignar Materias al Grupo</h3>

        <form data-target="/api/groups/{id}/assignments" class="upload-form space-y-4" data-method="put" data-debug="true" data-show-alert="true" data-reload="true">
            <div id="materia_asignaciones"></div>

            <div class="flex justify-between items-center">
                <button type="button" class="btn btn-secondary" onclick="agregarAsignacion()">+ Otra Materia</button>
                <div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn" onclick="document.getElementById('assing-subjects-modal').close()">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<template id="asignacion-template">
    <div class="asignacion flex gap-3 items-center mb-2">
        <select name="materias[]" class="select select-bordered w-full" required>
            <option value="">Selecciona una materia</option>
            @foreach($materias as $materia)
            <option value="{{ $materia->materia_id }}">{{ $materia->materia_nombre }}</option>
            @endforeach
        </select>

        <select name="docentes[]" class="select select-bordered w-full" required>
            <option value="">Selecciona un docente</option>
            @foreach($docentes as $docente)
            <option value="{{ $docente->docente_id }}">
                {{ substr($docente->usuario->usuario_documento, 0, 5) }} - {{ $docente->usuario->usuario_nombre }} {{ $docente->usuario->usuario_apellido }}
            </option>
            @endforeach
        </select>

        <button type="button" class="btn btn-sm btn-error" onclick="eliminarAsignacion(this)">✕</button>
    </div>
</template>

@endsection

@section('scripts')

<script>
    function openEditGroupModal(id, grupoJSONString) {
        const $form = document.querySelector('#edit-group-modal form');
        $form.setAttribute('data-target', `/api/groups/${id}`);

        const grupo = JSON.parse(grupoJSONString);

        document.getElementById('edit_grupo_nombre').value = grupo.grupo_nombre;
        document.getElementById('edit_grado_id').value = grupo.grado_id;
        document.getElementById('edit_grupo_cupo').value = grupo.grupo_cupo;
        document.getElementById('edit_grupo_año').value = grupo.grupo_año;

        document.getElementById('edit-group-modal').show();
    }

    async function confirmDeleteGroup(grupoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then(async (result) => {
            if (!result.isConfirmed) return;

            document.querySelector('#delete-group-form').setAttribute('data-target', `/api/groups/${grupoId}`);
            document.querySelector('#delete-group-form button').click();
        });
    }

    function openAssignSubjectsModal(grupoId, grupoJSONString) {
        const $form = document.querySelector('#assing-subjects-modal form');
        $form.setAttribute('data-target', `/api/groups/${grupoId}/assignments`);

        const grupo = JSON.parse(grupoJSONString);
        const assignments = grupo.asignaciones || [];

        const $contenedor = document.getElementById('materia_asignaciones');
        $contenedor.innerHTML = '';

        if (assignments.length > 0) {
            assignments.forEach(assignment => {
                const nuevaAsignacion = agregarAsignacion(assignment.materia_id, assignment.docente_id);
            });
        } else {
            agregarAsignacion();
        }

        document.getElementById('assing-subjects-modal').show();
    }

    function agregarAsignacion(materiaId, docenteId) {
        const $contenedor = document.getElementById('materia_asignaciones');
        const nuevaAsignacion = document.getElementById('asignacion-template').content.cloneNode(true);

        if (materiaId && docenteId) {
            nuevaAsignacion.querySelector('select[name="materias[]"]').value = materiaId;
            nuevaAsignacion.querySelector('select[name="docentes[]"]').value = docenteId;
        }

        $contenedor.appendChild(nuevaAsignacion);
        actualizarOpcionesMaterias();
    }

    function eliminarAsignacion(btn) {
        const $contenedor = document.getElementById('materia_asignaciones');
        if ($contenedor.children.length > 1) {
            btn.parentElement.remove();
        }
    }

    document.addEventListener('change', function(e) {
        if (e.target && e.target.name === 'materias[]') {
            actualizarOpcionesMaterias();
        }
    });

    function actualizarOpcionesMaterias() {
        const selects = document.querySelectorAll('select[name="materias[]"]');
        const seleccionadas = Array.from(selects)
            .map(select => select.value)
            .filter(val => val !== '');

        selects.forEach(select => {
            const opciones = select.querySelectorAll('option');
            opciones.forEach(opcion => {
                if (opcion.value === '') return;

                opcion.hidden = false;

                if (seleccionadas.includes(opcion.value) && opcion.value !== select.value) {
                    opcion.hidden = true;
                }
            });
        });
    }
</script>
@endsection