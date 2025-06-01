@extends('layouts.app')

@section('title', 'Gestión Materias')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Gestión Materias</h1>
            <button class="btn btn-primary" onclick="document.getElementById('create_subject_modal').show()">Crear Nueva Materia</button>
        </div>

        @if($materias->count() > 0)
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Materia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materias as $materia)
                    <tr>
                        <td>{{ explode("-", $materia->materia_id)[0] }}</td>
                        <td>{{ $materia->materia_nombre }}</td>
                        <td>
                            <div class="flex flex-wrap gap-2">
                                <button class="btn btn-sm py-1 btn-primary" onclick="openEditSubjectModal('{{ $materia->materia_id }}', '{{ json_encode($materia) }}')">Editar</button>
                                <button class="btn btn-sm py-1 btn-error" onclick="confirmDeleteSubject('{{ $materia->materia_id }}')">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $materias->links('components.pagination') }}
        @else
        <p>No hay materias registradas para esta institución.</p>
        @endif
    </div>
</section>

<!-- Create Subject Modal -->
<dialog id="create_subject_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Crear Nueva Materia</h3>
        <form data-target="/api/subjects" data-method="post" data-show-alert="true" data-reload="true" class="upload-form py-4 space-y-3">
            <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}">

            <fieldset class="w-full fieldset">
                <label for="create_materia_nombre" class="fieldset-label">Nombre de la Materia:</label>
                <input type="text" id="create_materia_nombre" name="materia_nombre" class="input input-bordered w-full" required>
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn" onclick="document.getElementById('create_subject_modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<!-- Edit Subject Modal -->
<dialog id="edit-subject-modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Editar Materia</h3>
        <form data-target="/api/subjects/{id}" data-method="put" data-show-alert="true" data-reload="true" class="upload-form py-4 space-y-3">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="edit_materia_id" name="materia_id" value="">
            <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}"> {{-- Generalmente no se cambia la institución --}}

            <fieldset class="w-full fieldset">
                <label for="edit_materia_nombre" class="fieldset-label">Nombre de la Materia:</label>
                <input type="text" id="edit_materia_nombre" name="materia_nombre" class="input input-bordered w-full" required>
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn" onclick="document.getElementById('edit-subject-modal').close()">Cancelar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<!-- Delete Subject Form -->
<form id="delete-subject-form" class="upload-form hidden" data-target="/api/subjects/{id}" data-method="delete" data-show-alert="true" data-reload="true">
    <button type="submit" class="hidden"></button>
</form>
@endsection

@section('scripts')
<script>
    function openEditSubjectModal(id, materiaJSONString) {
        materia = JSON.parse(materiaJSONString);

        document.getElementById('edit_materia_nombre').value = materia.materia_nombre;

        const $form = document.querySelector('#edit-subject-modal form');
        $form.setAttribute('data-target', `/api/subjects/${id}`);

        document.getElementById('edit-subject-modal').show();
    }

    async function confirmDeleteSubject(materiaId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then(async (result) => {
            if (!result.isConfirmed) return;

            document.getElementById('delete-subject-form').dataset.target = `/api/subjects/${materiaId}`;
            document.querySelector('#delete-subject-form button').click();
        });
    }
</script>
@endsection