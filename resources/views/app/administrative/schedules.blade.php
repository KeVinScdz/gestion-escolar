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
        <div class="card bg-base-200 border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Generar Horario Semanal (Próximamente)</h2>
                <p>Esta sección permitirá generar automáticamente los horarios basados en las horas hábiles definidas.</p>
                <!-- Aquí iría la lógica o UI para la generación automática -->
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
</script>
@endsection