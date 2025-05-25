@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<section class="container mx-auto px-4 py-6 space-y-5">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 flex-1">Usuarios Registrados</h1>
        <div class="flex items-center justify-end gap-5">
            <form method="get" class="flex gap-2">
                <label class="input">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input type="search" name="search" placeholder="Buscar" value="{{ request('search') }}" />
                </label>
                @if(request('search'))
                <a href="/dashboard/usuarios" class="btn btn-error text-white bg-red-500 btn-sm">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </a>
                @endif
            </form>
            <a onclick="document.getElementById('create-user').show()" class="btn btn-primary">
                + Nuevo Usuario
            </a>
        </div>
    </div>
    <div class="overflow-x-auto rounded bg-base-200 border border-base-300">
        <table class="min-w-full text-sm text-base-content">
            <thead class="bg-bsae-300 border-b border-base-300">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Nombre</th>
                    <th class="px-6 py-3 text-left font-semibold">Correo</th>
                    <th class="px-6 py-3 text-left font-semibold">Rol</th>
                    <th class="px-6 py-3 text-left font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td class="px-6 py-4">{{ $usuario->usuario_nombre }}</td>
                    <td class="px-6 py-4">{{ $usuario->usuario_correo }}</td>
                    <td class="px-6 py-4">{{ $usuario->rol->rol_nombre ?? '' }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <button onclick="openEditUserModal('{{ $usuario->usuario_id }}', '{{ addslashes($usuario->usuario_nombre) }}', '{{ addslashes($usuario->usuario_correo) }}', '{{ addslashes($usuario->rol_id) }}')" class="btn btn-sm py-1 btn-primary">Editar</button>
                        <button onclick="deleteUser('{{ $usuario->usuario_id }}')" class="btn btn-sm py-1 btn-error">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4 text-gray-500">No hay usuarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $usuarios->links('components.pagination') }}
    <dialog id="create-user" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Crear Nuevo Usuario</h3>
            <form class="upload-form space-y-2" data-target="/api/users" data-method="post" data-reload="true" data-show-alert="true">
                <fieldset class="w-full fieldset mb-2">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_nombre">Nombre:</label>
                    <input id="usuario_nombre" name="usuario_nombre" class="input input-bordered w-full" value="{{ old('usuario_nombre') }}">
                </fieldset>
                <fieldset class="w-full fieldset mb-2">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_correo">Correo:</label>
                    <input id="usuario_correo" name="usuario_correo" class="input input-bordered w-full" value="{{ old('usuario_correo') }}">
                </fieldset>
                <fieldset class="w-full fieldset mb-2">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="rol_id">Rol:</label>
                    <select id="rol_id" name="rol_id" class="input input-bordered w-full">
                        @foreach($roles as $rol)
                            <option value="{{ $rol->rol_id }}">{{ $rol->rol_nombre }}</option>
                        @endforeach
                    </select>
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
    <dialog id="edit-user" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Editar Usuario</h3>
            <form id="editUserForm" class="space-y-2">
                <input type="hidden" id="edit_usuario_id" name="usuario_id">
                <fieldset class="w-full fieldset mb-2">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_nombre">Nombre:</label>
                    <input id="edit_usuario_nombre" name="usuario_nombre" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset mb-2">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_correo">Correo:</label>
                    <input id="edit_usuario_correo" name="usuario_correo" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset mb-2">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_rol_id">Rol:</label>
                    <select id="edit_rol_id" name="rol_id" class="input input-bordered w-full">
                        @foreach($roles as $rol)
                            <option value="{{ $rol->rol_id }}">{{ $rol->rol_nombre }}</option>
                        @endforeach
                    </select>
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
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function openEditUserModal(id, nombre, correo, rol_id) {
    document.getElementById('edit_usuario_id').value = id;
    document.getElementById('edit_usuario_nombre').value = nombre;
    document.getElementById('edit_usuario_correo').value = correo;
    document.getElementById('edit_rol_id').value = rol_id;
    document.getElementById('edit-user').showModal();
}

document.getElementById('editUserForm').onsubmit = async function(e) {
    e.preventDefault();
    const id = document.getElementById('edit_usuario_id').value;
    const data = {
        usuario_nombre: document.getElementById('edit_usuario_nombre').value,
        usuario_correo: document.getElementById('edit_usuario_correo').value,
        rol_id: document.getElementById('edit_rol_id').value
    };
    const response = await fetch(`/api/users/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    });
    if (response.ok) {
        location.reload();
    } else {
        Swal.fire('Error', 'Error al actualizar el usuario.', 'error');
    }
};

function deleteUser(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará el usuario de forma permanente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/api/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                if (response.ok) {
                    Swal.fire('Eliminado', 'El usuario ha sido eliminado.', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', 'Error al eliminar el usuario.', 'error');
                }
            });
        }
    });
}
</script>
@endsection