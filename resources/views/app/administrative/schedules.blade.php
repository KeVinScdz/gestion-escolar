@extends('layouts.app')

@section('title', 'Gestión de Horarios')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">Gestión de Horarios</h1>
        <!-- Primero modificar horas elegibles -->
        <div class="card bg-base-200 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Definir Bloques Horarios</h2>
                <form class="upload-form space-y-4" data-target="/api/blocks" data-reset="true" data-method="post" data-reload="true" data-show-alert="true">
                    <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}">

                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="bloque_dia">Día:</label>
                        <select id="bloque_dia" name="bloque_dia" class="select select-bordered w-full">
                            <option disabled selected>Seleccione un día</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miércoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                        </select>
                    </fieldset>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <fieldset class="w-full fieldset">
                            <label class="fieldset-label after:content-['*'] after:text-red-500" for="bloque_inicio">Hora de Inicio:</label>
                            <input type="time" id="bloque_inicio" name="bloque_inicio" class="input input-bordered w-full">
                        </fieldset>

                        <fieldset class="w-full fieldset">
                            <label class="fieldset-label after:content-['*'] after:text-red-500" for="bloque_fin">Hora de Fin:</label>
                            <input type="time" id="bloque_fin" name="bloque_fin" class="input input-bordered w-full">
                        </fieldset>
                    </div>

                    <div class="card-actions justify-end">
                        <button type="submit" class="btn btn-primary">Crear Horario</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de Horarios Existentes -->
        <div class="card bg-base-200 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Horarios Definidos</h2>
                @if($bloques->isEmpty())
                <p>No hay horarios definidos para esta institución.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Día</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bloques as $bloque)
                            <tr>
                                <td class="capitalize md:w-[50%]">{{ $bloque->bloque_dia }}</td>
                                <td>{{ \Carbon\Carbon::parse($bloque->bloque_inicio)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($bloque->bloque_fin)->format('h:i A') }}</td>
                                <td>
                                    <button class="btn py-1 btn-primary" onclick="editBlock('{{ $bloque->bloque_id }}', '{{ json_encode($bloque) }}')">Editar</button>
                                    <button class="btn py-1 btn-error" onclick="deleteBlock('{{ $bloque->bloque_id }}')">Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        <!-- Segundo generar horarios -->
        <div class="p-5 rounded-lg bg-base-200 border border-base-300 space-y-5">
            <h2 class="card-title">Gestionar Horario Semanal</h2>
            <div class="space-y-10">
                <form action="/dashboard/horarios" method="get" class="flex items-end gap-5">
                    <fieldset class="w-full fieldset m-0 p-0">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="">
                            Seleccionar el grupo
                        </label>
                        <select name="grupo_id" id="grupo_id" class="select select-bordered w-full">
                            <option value="">Seleccione un grupo</option>
                            @foreach($grupos as $grupo)
                            <option value="{{ $grupo->grupo_id }}" {{ $selectedGroupId == $grupo->grupo_id ? 'selected' : '' }}>{{ $grupo->grupo_nombre }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Obtener Horario</button>
                </form>

                @if(isset($selectedGroupId))
                <div class="w-full overflow-x-auto pb-10">
                    <div class="w-full min-w-[1200px] grid grid-cols-5 gap-5">

                        @foreach($bloquesHorario as $dia)
                        <div class="space-y-5">
                            <div class="w-full space-y-5 bg-neutral-content text-neutral border border-neutral p-2">
                                <h3 class="text-xl font-semibold text-center">{{ ucfirst($dia[0]->bloque_dia) }}</h3>
                            </div>
                            @foreach($dia as $bloque)
                            <div class="w-full bg-neutral-content border border-neutral text-neutral p-4 space-y-5">
                                <h3 class="text-lg font-medium tracking-tight">{{ $bloque->bloque_inicio }} - {{ $bloque->bloque_fin }}</h3>
                                @if($horarios->where('bloque_id', $bloque->bloque_id)->isEmpty())
                                <p>No hay asignaciones para este bloque.</p>
                                <div class="w-full flex justify-center">
                                    <button onclick="assignSubject('{{ $bloque->bloque_id }}')" class="btn btn-sm py-1 btn-primary">
                                        Asignar materia
                                    </button>
                                </div>
                                @else
                                @foreach($horarios->where('bloque_id', $bloque->bloque_id) as $horario)
                                <div class="w-full flex justify-between items-center">
                                    <h3 class="text-xl font-semibold">{{ $horario->asignacion->materia->materia_nombre }}</h3>
                                    <div class="dropdown dropdown-center">
                                        <div tabindex="0" role="button" class="btn btn-ghost w-7 h-7 rounded-full p-0">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </div>
                                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                                            <li>
                                                <a onclick="editAssignment('{{ $horario->horario_id }}')">Editar materia</a>
                                            </li>
                                            <li>
                                                <a onclick="deleteAssignment('{{ $horario->horario_id }}')">Eliminar asignacion</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Update Block Modal -->
<dialog id="update-block-modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Editar Bloque</h3>
        <form class="upload-form space-y-4" data-target="/api/blocks/{id}" data-reset="true" data-method="put" data-reload="true" data-show-alert="true">
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_bloque_dia">Día:</label>
                <select id="edit_bloque_dia" name="bloque_dia" class="select select-bordered w-full">
                    <option disabled selected>Seleccione un día</option>
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <option value="miércoles">Miércoles</option>
                    <option value="jueves">Jueves</option>
                    <option value="viernes">Viernes</option>
                </select>
            </fieldset>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_bloque_inicio">Hora de Inicio:</label>
                    <input type="time" id="edit_bloque_inicio" name="bloque_inicio" class="input input-bordered w-full">
                </fieldset>

                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_bloque_fin">Hora de Fin:</label>
                    <input type="time" id="edit_bloque_fin" name="bloque_fin" class="input input-bordered w-full">
                </fieldset>
            </div>
            <div class="modal-action">

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-error" onclick="document.getElementById('update-block-modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Delete Block Form -->
<form id="delete-block-form" class="upload-form hidden" data-target="/api/blocks/{id}" data-reset="true" data-method="delete" data-reload="true" data-show-alert="true">
    <button>Enviar</button>
</form>

<!-- Assing Subject Modal -->
<dialog id="assing-subject-modal" class="modal">
    <div class="modal-box space-y-5">
        <h3 class="font-bold text-lg">Asignar Materia</h3>
        <form class="upload-form space-y-4" data-target="/api/schedules" data-reset="true" data-method="post" data-reload="true" data-show-alert="true">
            <input type="hidden" name="bloque_id" id="assing_block_id">
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="assing_asignacion_id">Materia:</label>
                <select id="assing_asignacion_id" name="asignacion_id" class="select select-bordered w-full">
                    <option disabled selected>Seleccione una materia</option>
                    @foreach($asignaciones as $asignacion)
                    <option value="{{ $asignacion->asignacion_id }}">{{ $asignacion->materia->materia_nombre }} - {{ $asignacion->docente->usuario->usuario_nombre }} {{ $asignacion->docente->usuario->usuario_apellido }}</option>
                    @endforeach
                </select>
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Asignar</button>
                <button type="button" class="btn btn-error" onclick="document.getElementById('assing-subject-modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Update Assign Subject Modal -->
<dialog id="update-assign-subject-modal" class="modal">
    <div class="modal-box space-y-5">
        <h3 class="font-bold text-lg">Actualizar Asignación</h3>

        <form class="upload-form space-y-4" data-target="/api/schedules/{id}" data-reset="true" data-method="put" data-reload="true" data-show-alert="true">
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="assing_asignacion_id">Materia:</label>
                <select id="assing_asignacion_id" name="asignacion_id" class="select select-bordered w-full">
                    <option disabled selected>Seleccione una materia</option>
                    @foreach($asignaciones as $asignacion)
                    <option value="{{ $asignacion->asignacion_id }}">{{ $asignacion->materia->materia_nombre }} - {{ $asignacion->docente->usuario->usuario_nombre }} {{ $asignacion->docente->usuario->usuario_apellido }}</option>
                    @endforeach
                </select>
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-error" onclick="document.getElementById('update-assign-subject-modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Delete Assign Subject Form -->
<form id="delete-assign-subject-form" class="upload-form hidden" data-target="/api/schedules/{id}" data-method="delete" data-reload="true" data-show-alert="true">
    <button type="submit">Enviar</button>
</form>
@endsection

@section('scripts')
<script>
    // Editar Bloque
    function editBlock(id, blockJSONString) {
        const block = JSON.parse(blockJSONString);
        document.querySelector('#update-block-modal form').setAttribute('data-target', '/api/blocks/' + id);

        document.getElementById('edit_bloque_dia').value = block.bloque_dia;
        document.getElementById('edit_bloque_inicio').value = block.bloque_inicio.substring(0, 5);
        document.getElementById('edit_bloque_fin').value = block.bloque_fin.substring(0, 5);

        const updateBlockModal = document.getElementById('update-block-modal');
        updateBlockModal.show();
    }

    // Eliminar Bloque
    function deleteBlock(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (!result.isConfirmed) return;

            const deleteBlockForm = document.getElementById('delete-block-form');
            deleteBlockForm.setAttribute('data-target', '/api/blocks/' + id);

            document.querySelector('#delete-block-form button').click();
        })
    }

    // Asignar Materia
    function assignSubject(blockId) {
        const $assingSubjectModal = document.getElementById('assing-subject-modal');
        document.getElementById('assing_block_id').value = blockId;

        $assingSubjectModal.show();
    }

    function editAssignment(scheduleId) {
        const $editAssignSubjectModal = document.getElementById('update-assign-subject-modal');
        const $editAssignSubjectForm = document.querySelector('#update-assign-subject-modal form');

        $editAssignSubjectForm.dataset.target = '/api/schedules/' + scheduleId;

        $editAssignSubjectModal.show();
    }

    function deleteAssignment(scheduleId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
        }).then((result) => {
            if (!result.isConfirmed) return;

            const $deleteAssignSubjectForm = document.getElementById('delete-assign-subject-form');
            $deleteAssignSubjectForm.dataset.target = '/api/schedules/' + scheduleId;

            document.querySelector('#delete-assign-subject-form button').click();
        });
    }
</script>
@endsection