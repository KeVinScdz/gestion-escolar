@extends('layouts.app')

@section('title', 'Matrículas')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="flex flex-col md:flex-row gap-10 justify-between items-center">
            <h1 class="text-2xl font-bold flex-1">Gestión de Matrículas</h1>
            <div class="flex items-center justify-end gap-5">
                <form method="get" class="flex gap-2">
                    <label class="input">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </g>
                        </svg>
                        <input type="search" name="search" placeholder="Buscar Estudiante o Tutor" value="{{ request('search') }}" />
                    </label>
                    @if(request('search'))
                    <a href="/dashboard/estudiantes" class="btn btn-error text-white bg-red-500 btn-sm">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </a>
                    @endif
                </form>
                <a onclick="document.getElementById('create-student').show()" class="btn btn-primary">
                    + Nueva Matrícula
                </a>
            </div>
        </div>
        <div class="w-full rounded bg-base-200 border border-base-300">
            <div class="overflow-x-auto w-full">
                <table class="table w-full min-w-[1100px]">
                    <thead class="bg-bsae-300 border-b border-base-300 text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Documento</th>
                            <th>Tutor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estudiantes as $estudiante)
                        <tr>
                            <td>{{ explode("-", $estudiante->usuario->usuario_id)[0] }}</td>
                            <td>{{ $estudiante->usuario->usuario_nombre }} {{ $estudiante->usuario->usuario_apellido }}</td>
                            <td>{{ $estudiante->usuario->usuario_correo }}</td>
                            <td>{{ $estudiante->usuario->usuario_documento_tipo }}: {{ $estudiante->usuario->usuario_documento }}</td>
                            <td>
                                @if($estudiante->tutor)
                                {{ $estudiante->tutor->usuario->usuario_nombre ?? 'N/A' }} {{ $estudiante->tutor->usuario->usuario_apellido ?? '' }}
                                (Tutor)
                                @else
                                Sin tutor asignado
                                @endif
                            </td>
                            <td>
                                @if($estudiante->matriculas && $estudiante->matriculas->count() > 0)
                                @php
                                $matriculaActual = $estudiante->matriculas->where('matricula_año', date('Y'))->first();
                                $ultimaMatricula = $estudiante->matriculas->sortByDesc('matricula_año')->first();
                                @endphp

                                @if($matriculaActual)
                                <span>Matriculado en el grupo {{ $matriculaActual->grupo->grupo_nombre }}</span>
                                @else
                                <span>No renovado desde {{ $ultimaMatricula->matricula_año }}</span>
                                @endif

                                @else
                                No se le ha asignado ninguna matricula
                                @endif
                            </td>
                            <td>
                                <div class="flex flex-wrap gap-2 w-fit">
                                    @if(!$estudiante->tutor)
                                    <button
                                        onclick="asignarTutor('{{ $estudiante->estudiante_id }}', '{{ $estudiante->usuario_nombre }} {{ $estudiante->usuario_apellido }}')"
                                        class="btn btn-sm py-1 btn-primary">
                                        Asignar Tutor
                                    </button>
                                    @endif
                                    <button onclick="asignarMatricula('{{ $estudiante->estudiante_id }}')" class="btn btn-sm py-1 btn-primary btn-outline">Asignar matricula</button>
                                    @if($estudiante->matriculas && $estudiante->matriculas->count() > 0 && $matriculaActual)
                                    <button onclick="actualizarMatricula('{{ $matriculaActual->matricula_id }}', '{{ json_encode($matriculaActual) }}')"
                                        class="btn btn-sm py-1 btn-secondary btn-outline">Actualizar Matrícula</button>
                                    @endif
                                    <button onclick="editarUsuario('{{ $estudiante->usuario->usuario_id }}', '{{ json_encode($estudiante->usuario) }}')" class="btn btn-sm py-1 btn-primary">Editar</button>
                                    <button onclick="eliminarUsuario('{{ $estudiante->usuario->usuario_id }}')" class="btn btn-sm py-1 btn-error">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center px-6 py-4 text-gray-500">No hay estudiantes o tutores registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $estudiantes->links('components.pagination') }}

    </div>
</section>

<!-- Create Student Modal -->
<dialog id="create-student" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-4">Crear Nuevo Estudiante</h3>
        <form class="upload-form space-y-2" data-target="/api/users" data-reset="true" data-method="post" data-reload="true" data-show-alert="true">
            <input type="hidden" name="rol_id" value="4">
            <input type="hidden" name="institucion_id" value="{{ $usuarioSesion->administrativo->institucion_id }}">

            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_nombre">Nombre:</label>
                <input id="estudiante_nombre" name="usuario_nombre" class="input input-bordered w-full" value="{{ old('usuario_nombre') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_apellido">Apellido:</label>
                <input id="estudiante_apellido" name="usuario_apellido" class="input input-bordered w-full" value="{{ old('usuario_apellido') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_correo">Correo:</label>
                <input type="email" id="estudiante_correo" name="usuario_correo" class="input input-bordered w-full" value="{{ old('usuario_correo') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_telefono">Teléfono:</label>
                <input type="number" id="estudiante_telefono" name="usuario_telefono" class="input input-bordered w-full" value="{{ old('usuario_telefono') }}">
            </fieldset>
            <div class="w-full flex gap-2">
                <fieldset class="fieldset w-fit">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_documento_tipo">Tipo de Documento:</label>
                    <select id="estudiante_documento_tipo" name="usuario_documento_tipo" class="select select-bordered w-fit">
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                    </select>
                </fieldset>
                <fieldset class="w-full fieldset grow">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_documento">Número de Documento:</label>
                    <input id="estudiante_documento" name="usuario_documento" class="input input-bordered w-full" value="{{ old('usuario_documento') }}">
                </fieldset>
            </div>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="estudiante_nacimiento" name="usuario_nacimiento" class="input input-bordered w-full" value="{{ old('usuario_nacimiento') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_direccion">Dirección:</label>
                <input id="estudiante_direccion" name="usuario_direccion" class="input input-bordered w-full" value="{{ old('usuario_direccion') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="estudiante_contra">Contraseña:</label>
                <input type="password" id="estudiante_contra" name="usuario_contra" class="input input-bordered w-full">
            </fieldset>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Crear Estudiante</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Edit Student Modal -->
<dialog id="edit-student" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-4">Editar estudiante</h3>
        <form class="upload-form space-y-2" data-target="/api/users/{id}" data-reset="true" data-method="put" data-reload="true" data-show-alert="true">
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_nombre">Nombre:</label>
                <input id="editar_estudiante_nombre" name="usuario_nombre" class="input input-bordered w-full" value="{{ old('usuario_nombre') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_apellido">Apellido:</label>
                <input id="editar_estudiante_apellido" name="usuario_apellido" class="input input-bordered w-full" value="{{ old('usuario_apellido') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_correo">Correo:</label>
                <input type="email" id="editar_estudiante_correo" name="usuario_correo" class="input input-bordered w-full" value="{{ old('usuario_correo') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_telefono">Teléfono:</label>
                <input type="number" id="editar_estudiante_telefono" name="usuario_telefono" class="input input-bordered w-full" value="{{ old('usuario_telefono') }}">
            </fieldset>
            <div class="w-full flex gap-2">
                <fieldset class="fieldset w-fit">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_documento_tipo">Tipo de Documento:</label>
                    <select id="editar_estudiante_documento_tipo" name="usuario_documento_tipo" class="select select-bordered w-fit">
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                    </select>
                </fieldset>
                <fieldset class="w-full fieldset grow">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_documento">Número de Documento:</label>
                    <input id="editar_estudiante_documento" name="usuario_documento" class="input input-bordered w-full" value="{{ old('usuario_documento') }}">
                </fieldset>
            </div>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="editar_estudiante_nacimiento" name="usuario_nacimiento" class="input input-bordered w-full" value="{{ old('usuario_nacimiento') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="editar_estudiante_direccion">Dirección:</label>
                <input id="editar_estudiante_direccion" name="usuario_direccion" class="input input-bordered w-full" value="{{ old('usuario_direccion') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label" for="editar_estudiante_contra">Contraseña (Dejar vacio si no se actualiza):</label>
                <input type="password" id="editar_estudiante_contra" name="usuario_contra" class="input input-bordered w-full">
            </fieldset>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar estudiante</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Crear un nuevo tutor para un usuario -->
<dialog id="create-tutor" class="modal">
    <div class="modal-box">
        <h3 id="tutor-title" class="text-lg font-bold mb-4">ASignar tutor</h3>
        <form class="upload-form space-y-2" data-target="/api/users" data-reset="true" data-method="post" data-reload="true" data-show-alert="true">
            <input type="hidden" name="rol_id" value="5">
            <input type="hidden" id="estudiante_id" name="estudiante_id" value="">

            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_nombre">Nombre:</label>
                <input id="tutor_nombre" name="usuario_nombre" class="input input-bordered w-full" value="{{ old('usuario_nombre') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_apellido">Apellido:</label>
                <input id="tutor_apellido" name="usuario_apellido" class="input input-bordered w-full" value="{{ old('usuario_apellido') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_correo">Correo:</label>
                <input type="email" id="tutor_correo" name="usuario_correo" class="input input-bordered w-full" value="{{ old('usuario_correo') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_telefono">Teléfono:</label>
                <input type="number" id="tutor_telefono" name="usuario_telefono" class="input input-bordered w-full" value="{{ old('usuario_telefono') }}">
            </fieldset>
            <div class="w-full flex gap-2">
                <fieldset class="fieldset w-fit">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_documento_tipo">Tipo de Documento:</label>
                    <select id="tutor_documento_tipo" name="usuario_documento_tipo" class="select select-bordered w-fit">
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                    </select>
                </fieldset>
                <fieldset class="w-full fieldset grow">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_documento">Número de Documento:</label>
                    <input id="tutor_documento" name="usuario_documento" class="input input-bordered w-full" value="{{ old('usuario_documento') }}">
                </fieldset>
            </div>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="tutor_nacimiento" name="usuario_nacimiento" class="input input-bordered w-full" value="{{ old('usuario_nacimiento') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_direccion">Dirección:</label>
                <input id="tutor_direccion" name="usuario_direccion" class="input input-bordered w-full" value="{{ old('usuario_direccion') }}">
            </fieldset>
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="tutor_contra">Contraseña:</label>
                <input type="password" id="tutor_contra" name="usuario_contra" class="input input-bordered w-full">
            </fieldset>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">
                    Asignar Tutor
                </button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Modal Asignar Matrícula -->
<dialog id="asignar-matricula" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-4">Asignar Matrícula</h3>
        <form class="upload-form space-y-2" data-target="/api/enrollments" data-method="post" data-reload="true" data-show-alert="true">
            <input type="hidden" name="estudiante_id" id="matricula_estudiante_id">

            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="matricula_año">Año:</label>
                <input type="number" min="2000" max="2100" id="matricula_año" name="matricula_año"
                    class="input input-bordered w-full" value="{{ date('Y') }}">
            </fieldset>

            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="grupo_id">Salón:</label>
                <select id="grupo_id" name="grupo_id" class="select select-bordered w-full">
                    @foreach ($grupos as $grupo)
                    <option value="{{ $grupo->grupo_id }}">
                        {{ $grupo->grupo_nombre }}: @if ($grupo->grado->nivel->nivel_nombre == 'Preescolar')
                        {{ $grupo->grado->grado_nombre }}
                        @else
                        {{ $grupo->grado->grado_nombre }} de {{ $grupo->grado->nivel->nivel_nombre }}
                        @endif
                    </option>
                    @endforeach
                </select>
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Asignar Matrícula</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>

<!-- Update Enrollment Modal -->
<dialog id="update-enrollment-modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-4">Actualizar Matrícula</h3>
        <form class="upload-form space-y-2" data-target="/api/enrollments/{id}" data-method="put" data-reload="true" data-show-alert="true">
            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="update_matricula_año">Año:</label>
                <input type="number" min="1900" max="2100" id="update_matricula_año" name="matricula_año"
                    class="input input-bordered w-full" value="{{ date('Y') }}">
            </fieldset>

            <fieldset class="w-full fieldset">
                <label class="fieldset-label after:content-['*'] after:text-red-500" for="update_grupo_id">Salón:</label>
                <select id="update_grupo_id" name="grupo_id" class="select select-bordered w-full">
                    @foreach ($grupos as $grupo)
                    <option value="{{ $grupo->grupo_id }}">
                        {{ $grupo->grupo_nombre }}: @if ($grupo->grado->nivel->nivel_nombre == 'Preescolar')
                        {{ $grupo->grado->grado_nombre }}
                        @else
                        {{ $grupo->grado->grado_nombre }} de {{ $grupo->grado->nivel->nivel_nombre }}
                        @endif
                    </option>
                    @endforeach
                </select>
            </fieldset>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar Matrícula</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>

<!-- Delete User Form -->
<form class="upload-form hidden" id="delete-user-form" data-target="/api/users/{id}" data-method="delete" data-reload="true" data-show-alert="true">
    <button type="submit"></button>
</form>
@endsection

@section('scripts')
<script>
    function editarUsuario(id, usuarioJsonString) {
        const usuario = JSON.parse(usuarioJsonString);

        document.getElementById('edit-student').show();
        document.querySelector('#edit-student form').dataset.target = `/api/users/${id}`;

        document.getElementById('editar_estudiante_nombre').value = usuario.usuario_nombre;
        document.getElementById('editar_estudiante_apellido').value = usuario.usuario_apellido;
        document.getElementById('editar_estudiante_correo').value = usuario.usuario_correo;
        document.getElementById('editar_estudiante_telefono').value = usuario.usuario_telefono;
        document.getElementById('editar_estudiante_documento_tipo').value = usuario.usuario_documento_tipo;
        document.getElementById('editar_estudiante_documento').value = usuario.usuario_documento;
        document.getElementById('editar_estudiante_nacimiento').value = usuario.usuario_nacimiento;
        document.getElementById('editar_estudiante_direccion').value = usuario.usuario_direccion;
    }

    function eliminarUsuario(id) {
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

            document.getElementById('delete-user-form').dataset.target = `/api/users/${id}`;
            document.querySelector('#delete-user-form button').click();
        })
    }

    function asignarTutor(id, name) {
        document.getElementById('create-tutor').show();
        document.getElementById('estudiante_id').value = id;
        document.getElementById('tutor-title').innerText = `Asignar tutor a ${name}`;
    }

    function asignarMatricula(estudianteId) {
        document.getElementById('asignar-matricula').show();
        document.getElementById('matricula_estudiante_id').value = estudianteId;
    }

    function actualizarMatricula(id, matriculaJSONString) {
        const matricula = JSON.parse(matriculaJSONString);

        document.getElementById('update-enrollment-modal').show();
        document.querySelector('#update-enrollment-modal form').dataset.target = `/api/enrollments/${id}`;

        document.getElementById('update_matricula_año').value = matricula.matricula_año;
        document.getElementById('update_grupo_id').value = matricula.grupo_id;
    }
</script>
@endsection