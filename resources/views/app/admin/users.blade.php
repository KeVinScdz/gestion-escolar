@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<section class="container mx-auto px-4 py-6 space-y-5">
    <div class="flex flex-col md:flex-row gap-5 justify-between items-center">
        <h1 class="text-2xl font-bold flex-1">Usuarios Registrados</h1>
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
                    <td class="px-6 py-4">{{ $usuario->usuario_nombre }} {{ $usuario->usuario_apellido }}</td>
                    <td class="px-6 py-4">{{ $usuario->usuario_correo }}</td>
                    <td class="px-6 py-4">
                    {{ $usuario->rol->rol_nombre ?? '' }}
                    @if($usuario->rol_id == 2)
                    del {{ $usuario->administrativo->institucion->institucion_nombre }}
                    @elseif ($usuario->rol_id == 3)
                    del {{ $usuario->docente->institucion->institucion_nombre }}
                    @elseif ($usuario->rol_id == 4)
                    del {{ $usuario->estudiante->institucion->institucion_nombre }}
                    @elseif ($usuario->rol_id == 5)
                    del {{ explode(" ",  $usuario->tutor->estudiante->usuario->usuario_nombre)[0] }} {{ explode(" ",  $usuario->tutor->estudiante->usuario->usuario_apellido)[0] }}
                    @endif
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <button
                            onclick="openEditUserModal('{{ $usuario->usuario_id }}', '{{ json_encode($usuario) }}')"
                            {{ $usuario->usuario_id == $usuarioSesion->usuario_id ? 'disabled' : '' }}
                            class="btn btn-sm py-1 btn-primary">
                            Editar
                        </button>
                        <button
                            onclick="deleteUser('{{ $usuario->usuario_id }}')"
                            {{ $usuario->usuario_id == $usuarioSesion->usuario_id ? 'disabled' : '' }}
                            class="btn btn-sm py-1 btn-error">
                            Eliminar
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4 text-base-content/50">No hay usuarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $usuarios->links('components.pagination') }}

    <dialog id="create-user" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Crear Nuevo Usuario</h3>
            <form class="upload-form space-y-2" data-target="/api/users" data-reset="true" data-method="post" data-reload="true" data-show-alert="true">
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_nombre">Nombre:</label>
                    <input id="usuario_nombre" name="usuario_nombre" class="input input-bordered w-full" value="{{ old('usuario_nombre') }}">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_apellido">Apellido:</label>
                    <input id="usuario_apellido" name="usuario_apellido" class="input input-bordered w-full" value="{{ old('usuario_apellido') }}">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_correo">Correo:</label>
                    <input type="email" id="usuario_correo" name="usuario_correo" class="input input-bordered w-full" value="{{ old('usuario_correo') }}">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_telefono">Teléfono:</label>
                    <input type="number" id="usuario_telefono" name="usuario_telefono" class="input input-bordered w-full" value="{{ old('usuario_telefono') }}">
                </fieldset>
                <div class="w-full flex gap-2">
                    <fieldset class="fieldset w-fit">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_documento_tipo">Tipo de Documento:</label>
                        <select id="usuario_documento_tipo" name="usuario_documento_tipo" class="select select-bordered w-fit">
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </fieldset>
                    <fieldset class="w-full fieldset grow">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_documento">Número de Documento:</label>
                        <input id="usuario_documento" name="usuario_documento" class="input input-bordered w-full" value="{{ old('usuario_documento') }}">
                    </fieldset>
                </div>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="usuario_nacimiento" name="usuario_nacimiento" class="input input-bordered w-full" value="{{ old('usuario_nacimiento') }}">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_direccion">Dirección:</label>
                    <input id="usuario_direccion" name="usuario_direccion" class="input input-bordered w-full" value="{{ old('usuario_direccion') }}">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_contra">Contraseña:</label>
                    <input type="password" id="usuario_contra" name="usuario_contra" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="rol_id">Rol:</label>
                    <select id="rol_id" name="rol_id" class="select select-bordered w-full" onchange="handleRoleChange(this)">
                        @foreach($roles as $rol)
                        <option value="{{ $rol->rol_id }}" data-rol-nombre="{{ $rol->rol_nombre }}">{{ $rol->rol_nombre }}</option>
                        @endforeach
                    </select>
                </fieldset>

                {{-- Institucion Fields --}}
                <fieldset id="institucion_fieldset" class="w-full fieldset" style="display: none;">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_id">Institución:</label>
                    <select id="institucion_id" name="institucion_id" class="select select-bordered w-full">
                        @foreach($instituciones as $institucion)
                        <option value="{{ $institucion->institucion_id }}">{{ $institucion->institucion_nombre }}</option>
                        @endforeach
                    </select>
                </fieldset>

                {{-- Administrativo Fields --}}
                <fieldset id="administrativo_fieldset" class="w-full fieldset" style="display: none;">
                    <fieldset class="w-full fieldset">

                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="administrativo_cargo">Cargo:</label>
                        <input id="administrativo_cargo" name="administrativo_cargo" class="input input-bordered w-full" value="{{ old('administrativo_cargo') }}">
                    </fieldset>
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="administrativo_permisos">Permisos:</label>
                    <div class="grid grid-cols-2 gap-1">
                        @foreach($permisos as $permiso)
                        <label class="label">
                            <input type="checkbox" name="permisos[]" value="{{ $permiso->permiso_id }}" class="checkbox checkbox-sm" />
                            {{ $permiso->permiso_nombre }}
                        </label>
                        @endforeach
                    </div>
                </fieldset>

                {{-- Docente Fields --}}
                <fieldset id="docente_fieldset" class="w-full fieldset space-y-2" style="display: none;">
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="docente_especialidad">Especialidad:</label>
                        <input id="docente_especialidad" name="docente_especialidad" class="input input-bordered w-full" value="{{ old('docente_especialidad') }}">
                    </fieldset>
                </fieldset>

                {{-- Estudiante Fields --}}
                <fieldset id="estudiante_fieldset" class="w-full fieldset" style="display: none;">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_id">Estudiante:</label>
                    <select id="estudiante_id" name="estudiante_id" class="select select-bordered w-full">
                        @foreach($estudiantes as $estudiante)
                        @if(is_null($estudiante->tutor))
                        <option value="{{ $estudiante->estudiante_id }}">
                            {{ $estudiante->usuario->usuario_documento_tipo}} {{ $estudiante->usuario->usuario_documento}} - {{ $estudiante->usuario->usuario_nombre }} {{ $estudiante->usuario->usuario_apellido  }}
                        </option>
                        @endif
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
            <form id="editUserForm" class="upload-form space-y-2" data-target="/api/users/{id}" data-method="put" data-reload="true" data-show-alert="true">
                <input type="hidden" id="edit_usuario_id" name="usuario_id">
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_nombre">Nombre:</label>
                    <input id="edit_usuario_nombre" name="usuario_nombre" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_apellido">Apellido:</label>
                    <input id="edit_usuario_apellido" name="usuario_apellido" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_correo">Correo:</label>
                    <input type="email" id="edit_usuario_correo" name="usuario_correo" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_telefono">Teléfono:</label>
                    <input type="number" id="edit_usuario_telefono" name="usuario_telefono" class="input input-bordered w-full">
                </fieldset>
                <div class="w-full flex gap-2">
                    <fieldset class="fieldset w-fit">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_documento_tipo">Tipo de Documento:</label>
                        <select id="edit_usuario_documento_tipo" name="usuario_documento_tipo" class="select select-bordered w-fit">
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </fieldset>
                    <fieldset class="w-full fieldset grow">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_documento">Número de Documento:</label>
                        <input id="edit_usuario_documento" name="usuario_documento" class="input input-bordered w-full">
                    </fieldset>
                </div>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="edit_usuario_nacimiento" name="usuario_nacimiento" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_usuario_direccion">Dirección:</label>
                    <input id="edit_usuario_direccion" name="usuario_direccion" class="input input-bordered w-full">
                </fieldset>
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label" for="edit_usuario_contra">Nueva Contraseña (dejar en blanco para no cambiar):</label>
                    <input type="password" id="edit_usuario_contra" name="usuario_contra" class="input input-bordered w-full">
                </fieldset>

                <fieldset id="edit_administrativo_fieldset" class="w-full fieldset hidden">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="edit_administrativo_cargo">Permisos:</label>
                    <div class="grid grid-cols-2 gap-1">
                        @foreach($permisos as $permiso)
                        <label class="label">
                            <input type="checkbox" name="permisos[]" value="{{ $permiso->permiso_id }}" class="checkbox checkbox-sm" />
                            {{ $permiso->permiso_nombre }}
                        </label>
                        @endforeach
                    </div>
                </fieldset>

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <form id="delete-user-form" class="upload-form hidden" data-target="/users/{id}" data-method="delete" data-show-alert="true" data-reload="true">
        <button type="submit"></button>
    </form>
</section>
@endsection

@section('scripts')
<script>
    function openEditUserModal(id, stringJson) {
        const usuario = JSON.parse(stringJson);

        document.getElementById('edit_usuario_id').value = id;
        document.getElementById('edit_usuario_nombre').value = usuario.usuario_nombre;
        document.getElementById('edit_usuario_apellido').value = usuario.usuario_apellido;
        document.getElementById('edit_usuario_correo').value = usuario.usuario_correo;
        document.getElementById('edit_usuario_telefono').value = usuario.usuario_telefono;
        document.getElementById('edit_usuario_documento_tipo').value = usuario.usuario_documento_tipo;
        document.getElementById('edit_usuario_documento').value = usuario.usuario_documento;
        document.getElementById('edit_usuario_nacimiento').value = usuario.usuario_nacimiento;
        document.getElementById('edit_usuario_direccion').value = usuario.usuario_direccion;
        document.querySelector('#edit-user form').dataset.target = '/api/users/' + id;

        if (usuario.rol_id == 2) {
            const permisos = usuario.administrativo.permisos.map(permiso => permiso.permiso_id);
            permisos.forEach(permiso_id => {
                document.querySelector(`#edit-user input[value="${permiso_id}"]`).checked = true;
            });
            document.getElementById('edit_administrativo_fieldset').style.display = 'block';
        } else {
            document.getElementById('edit_administrativo_fieldset').style.display = 'none';
        }

        document.getElementById('edit-user').show();
    }

    function handleRoleChange(selectElement) {
        const rol_id = selectElement.value;
        if (rol_id == 2 || rol_id == 3 || rol_id == 4) {
            document.getElementById('institucion_fieldset').style.display = 'block';
        } else {
            document.getElementById('institucion_fieldset').style.display = 'none';
        }

        if (rol_id == 2) {
            document.getElementById('administrativo_fieldset').style.display = 'block';
        } else {
            document.getElementById('administrativo_fieldset').style.display = 'none';
        }

        if (rol_id == 3) {
            document.getElementById('docente_fieldset').style.display = 'block';
        } else {
            document.getElementById('docente_fieldset').style.display = 'none';
        }

        if (rol_id == 5) {
            document.getElementById('estudiante_fieldset').style.display = 'block';
        } else {
            document.getElementById('estudiante_fieldset').style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const rolSelect = document.getElementById('rol_id');
        if (rolSelect) {
            handleRoleChange(rolSelect);
        }
    });

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
            if (!result.isConfirmed) return;

            const $form = document.getElementById('delete-user-form');
            const $button = $form.querySelector('button');

            $form.dataset.target = '/api/users/' + id;
            $button.click();
        });
    }
</script>
@endsection