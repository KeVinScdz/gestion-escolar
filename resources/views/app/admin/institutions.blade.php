@extends('layouts.app')

@section('title', 'Instituciones')

@section('content')
<section class="container mx-auto px-4 py-6 space-y-5">
    <div class="flex flex-col md:flex-row gap-5 justify-between items-center">
        <h1 class="text-2xl font-bold flex-1">Instituciones Registradas</h1>
        <div class="flex items-center justify-end gap-5">
            <form method="get" class="flex gap-2">
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
                    <input type="search" name="search" placeholder="Search" value="{{ request('search') }}" />
                </label>
                @if(request('search'))
                <a href="/dashboard/instituciones" class="btn btn-error text-white bg-red-500 btn-sm">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </a>
                @endif
            </form>
            <a onclick="document.getElementById('create-institution').show()" class="btn btn-primary">
                + Nueva Institución
            </a>
        </div>
    </div>

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
                        <button onclick="openEditModal( '{{ $institucion->institucion_id }}', '{{ json_encode($institucion) }}')" class="btn btn-sm py-1 btn-primary">
                            Editar
                        </button>
                        <button onclick="deleteInstitution( '{{ $institucion->institucion_id }}' )" class="btn btn-sm py-1 btn-error">
                            Eliminar
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4 text-base-content/80">
                        No hay instituciones registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $instituciones->links('components.pagination') }}

</section>

<!-- Create Institution Modal -->
<dialog id="create-institution" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-4">Crear Nueva Institución</h3>
        <form class="upload-form space-y-2" data-target="/api/institutions" data-method="post" data-reload="true" data-show-alert="true">
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_nombre">
                    Nombre:
                </label>
                <input
                    id="institucion_nombre"
                    name="institucion_nombre"
                    class="input input-bordered w-full"
                    placeholder="Ingresa el nombre de la institución"
                    value="{{ old('institucion_nombre') }}">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_telefono">
                    Teléfono:
                </label>
                <input
                    type="number"
                    id="institucion_telefono"
                    name="institucion_telefono"
                    class="input input-bordered w-full"
                    placeholder="Ingresa el número de teléfono de la institución"
                    value="{{ old('institucion_telefono') }}">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_correo">
                    Correo:
                </label>
                <input
                    id="institucion_correo"
                    name="institucion_correo"
                    class="input input-bordered w-full"
                    placeholder="Ingresa el correo de la institución"
                    value="{{ old('institucion_correo') }}">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_direccion">
                    Dirección:
                </label>
                <input
                    id="institucion_direccion"
                    name="institucion_direccion"
                    class="input input-bordered w-full"
                    placeholder="Ingresa la dirección de la institución"
                    value="{{ old('institucion_direccion') }}">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_nit">
                    NIT:
                </label>
                <input
                    id="institucion_nit"
                    name="institucion_nit"
                    type="text"
                    class="input input-bordered w-full"
                    placeholder="Ingresa el NIT de la institución"
                    value="{{ old('institucion_nit') }}">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label" for="nota_minima">Nota Mínima:</label>
                <input
                    id="nota_minima"
                    name="nota_minima"
                    type="number"
                    class="input input-bordered w-full"
                    placeholder="Ingresa la calificación más baja que se puede obtener"
                    value="{{ old('nota_minima') }}">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label" for="nota_maxima">Nota Máxima:</label>
                <input
                    id="nota_maxima"
                    name="nota_maxima"
                    type="number"
                    class="input input-bordered w-full"
                    placeholder="Ingresa la calificación más alta que se puede obtener"
                    value="{{ old('nota_maxima') }}">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label" for="nota_aprobatoria">Nota Aprobatoria:</label>
                <input
                    id="nota_aprobatoria"
                    name="nota_aprobatoria"
                    type="number"
                    class="input input-bordered w-full"
                    placeholder="Ingresa la calificación mínima para aprobar"
                    value="{{ old('nota_aprobatoria') }}">
            </fieldset>
            <div class="mt-4 flex justify-end">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Edit Institution Modal -->
<dialog id="edit-institution" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-4">Editar Institución</h3>
        <form data-target="/api/institutions/{id}" data-method="put" data-reload="true" data-show-alert="true" class="upload-form space-y-2">
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_institucion_nombre">
                    Nombre:
                </label>
                <input id="edit_institucion_nombre" name="institucion_nombre" class="input input-bordered w-full">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_institucion_telefono">
                    Teléfono:
                </label>
                <input type="number" id="edit_institucion_telefono" name="institucion_telefono" class="input input-bordered w-full">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_institucion_correo">
                    Correo:
                </label>
                <input id="edit_institucion_correo" name="institucion_correo" class="input input-bordered w-full">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_institucion_direccion">
                    Dirección:
                </label>
                <input id="edit_institucion_direccion" name="institucion_direccion" class="input input-bordered w-full">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_institucion_nit">
                    NIT:
                </label>
                <input id="edit_institucion_nit" name="institucion_nit" class="input input-bordered w-full">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label" for="edit_nota_minima">Nota Mínima:</label>
                <input id="edit_nota_minima" name="nota_minima" type="number" class="input input-bordered w-full">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label" for="edit_nota_maxima">Nota Máxima:</label>
                <input id="edit_nota_maxima" name="nota_maxima" type="number" class="input input-bordered w-full">
            </fieldset>
            <fieldset class="w-full fieldset mb-2">
                <label class="fieldset-label" for="edit_nota_aprobatoria">Nota Aprobatoria:</label>
                <input id="edit_nota_aprobatoria" name="nota_aprobatoria" type="number" class="input input-bordered w-full">
            </fieldset>
            <div class="mt-4 flex justify-end">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<form id="delete-form" class="upload-form hidden" data-target="/api/institutions/{id}" data-method="delete" data-show-alert="true" data-reload="true">
    <button type="submit"></button>
</form>
@endsection

@section('scripts')
<script>
    function openEditModal(id, institucionJSONString) {
        const institucion = JSON.parse(institucionJSONString);
        document.querySelector('#edit-institution form').dataset.target = `/api/institutions/${id}`;
        document.getElementById('edit_institucion_nombre').value = institucion.institucion_nombre;
        document.getElementById('edit_institucion_telefono').value = institucion.institucion_telefono;
        document.getElementById('edit_institucion_correo').value = institucion.institucion_correo;
        document.getElementById('edit_institucion_direccion').value = institucion.institucion_direccion;
        document.getElementById('edit_institucion_nit').value = institucion.institucion_nit;
        document.getElementById('edit_nota_minima').value = institucion.nota_minima;
        document.getElementById('edit_nota_maxima').value = institucion.nota_maxima;
        document.getElementById('edit_nota_aprobatoria').value = institucion.nota_aprobatoria;
        document.getElementById('edit-institution').show();
    }

    function deleteInstitution(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (!result.isConfirmed) return;
            console.log(id);
            document.getElementById('delete-form').dataset.target = `/api/institutions/${id}`;
            document.querySelector('#delete-form button').click();
        })
    }
</script>
@endsection