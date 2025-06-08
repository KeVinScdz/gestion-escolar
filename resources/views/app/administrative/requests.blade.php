@extends('layouts.app')

@section('title', 'Solicitudes de Matrícula')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="flex flex-col md:flex-row gap-10 justify-between items-center">
            <h1 class="text-2xl font-bold flex-1">Solicitudes de Matrícula</h1>
        </div>
        <div class="w-full rounded bg-base-200 border border-base-300">
            <div class="overflow-x-auto w-full">
                <table class="table w-full min-w-[1100px]">
                    <thead class="bg-bsae-300 border-b border-base-300 text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Estudiante</th>
                            <th>Grado</th>
                            <th>Tutor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($solicitudes as $solicitud)
                        <tr>
                            <td>
                                {{ $solicitud->solicitud_id }}
                            </td>
                            <td>
                                @if($solicitud->estudiante)
                                <div class="font-medium">
                                    {{ $solicitud->estudiante->usuario->usuario_nombre }} {{ $solicitud->estudiante->usuario->usuario_apellido }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $solicitud->estudiante->usuario->usuario_documento }}
                                </div>
                                @else
                                <div class="font-medium">
                                    {{ $solicitud->estudianteNuevo->estudiante_nombre }} {{ $solicitud->estudianteNuevo->estudiante_apellido }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $solicitud->estudianteNuevo->estudiante_documento }}
                                </div>
                                @endif
                            </td>
                            <td>{{ $solicitud->grado->grado_nombre }}</td>
                            <td>
                                <div class="font-medium">
                                    {{ $solicitud->tutorNuevo->tutor_nombre }} {{ $solicitud->tutorNuevo->tutor_apellido }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $solicitud->tutorNuevo->tutor_correo }}
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-warning">
                                    {{ ucfirst($solicitud->solicitud_estado) }}
                                </span>
                            </td>
                            <td>
                                <div class="flex flex-wrap gap-2 w-fit">
                                    <button onclick="showDetails('{{ $solicitud->solicitud_id }}', '{{ json_encode($solicitud) }}')" class="btn btn-sm py-1 btn-primary btn-outline">
                                        Ver detalles
                                    </button>
                                    @if($solicitud->estudiante)
                                    <button onclick="showEnrollModal('{{ $solicitud->solicitud_id }}', '{{ json_encode($solicitud) }}')" class="btn btn-sm py-1 btn-primary">
                                        Renovar matrícula
                                    </button>
                                    @else
                                    <button onclick="showCreateModal('{{ $solicitud->solicitud_id }}', '{{ json_encode($solicitud) }}')" class="btn btn-sm py-1 btn-primary">
                                        Crear y matricular
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center px-6 py-4 text-gray-500">
                                No hay solicitudes pendientes
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $solicitudes->links('components.pagination') }}
    </div>

    <!-- Details Modal -->
    <dialog id="detailsModal" class="modal">
        <div class="modal-box bg-base-200 w-11/12 max-w-3xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost h-8 w-8 absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold mb-4">Detalles de la Solicitud</h3>
            <div id="detailsContent" class="space-y-6">
                <!-- Información general -->
                <div class="card bg-base-100">
                    <div class="card-body">
                        <h4 class="card-title text-base">1. Información general de la solicitud</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">ID de solicitud:</p>
                                <p id="solicitud_id" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Grado solicitado:</p>
                                <p id="grado_nombre" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Estado de la solicitud:</p>
                                <p id="solicitud_estado" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Comentario del solicitante:</p>
                                <p id="solicitud_comentario" class="text-base"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datos del estudiante -->
                <div class="card bg-base-100">
                    <div class="card-body">
                        <h4 class="card-title text-base">2. Datos del estudiante</h4>
                        <div id="datos_estudiante" class="grid grid-cols-2 gap-4">
                            <div id="estudiante_existente" class="mb-4">
                                <p class="text-sm font-medium text-gray-500">¿Es estudiante antigüo?</p>
                                <p id="es_estudiante_existente" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nombre completo</p>
                                <p id="estudiante_nombre" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Documento</p>
                                <p id="estudiante_documento" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Fecha de nacimiento</p>
                                <p id="estudiante_nacimiento" class="text-base"></p>
                            </div>
                            <div id="matricula_actual_container">
                                <p class="text-sm font-medium text-gray-500">Matrícula actual</p>
                                <p id="matricula_actual" class="text-base"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datos del tutor -->
                <div class="card bg-base-100">
                    <div class="card-body">
                        <h4 class="card-title text-base">3. Datos de contacto del tutor</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nombre completo</p>
                                <p id="tutor_nombre" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Documento</p>
                                <p id="tutor_documento" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Teléfono</p>
                                <p id="tutor_telefono" class="text-base"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Correo electrónico</p>
                                <a href="mailto:#" id="tutor_correo" class="text-base hover:underline tooltip" data-tip="Enviar correo"></a>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500">Dirección</p>
                                <p id="tutor_direccion" class="text-base"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Enroll new student Modal -->
    <dialog id="createEnrollModal" class="modal">
        <div class="modal-box max-w-4xl bg-base-200">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>

            <h3 class="text-lg font-bold mb-4">Proceso de Matrícula</h3>

            <form id="matriculaForm" class="upload-form space-y-6" data-method="put" data-target="/api/enrollments-requests/{id}" data-debug="true" data-show-alert="true" data-reload="true">
                <input type="hidden" name="matricula_año" id="create_matricula_año" value="">
                <input type="hidden" name="institucion_id" id="create_institucion_id" value="{{ $institucion->institucion_id }}">
                <input type="hidden" name="es_nuevo" id="create_es_nuevo" value="true">

                <!-- ESTUDIANTE -->
                <div class="card bg-base-100">
                    <div class="card-body">
                        <h4 class="card-title text-base">1. Datos del nuevo estudiante</h4>
                        <div class="space-y-2">
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_nombre">Nombre:</label>
                                <input id="create_estudiante_nombre" name="estudiante_nombre" class="input input-bordered w-full" placeholder="Nombre del estudiante">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_apellido">Apellido:</label>
                                <input id="create_estudiante_apellido" name="estudiante_apellido" class="input input-bordered w-full" placeholder="Apellido del estudiante">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_correo">Correo:</label>
                                <input type="email" id="create_estudiante_correo" name="estudiante_correo" class="input input-bordered w-full" placeholder="Correo del estudiante">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_telefono">Teléfono:</label>
                                <input type="number" id="create_estudiante_telefono" name="estudiante_telefono" class="input input-bordered w-full" placeholder="Teléfono del estudiante">
                            </fieldset>
                            <div class="w-full flex gap-2">
                                <fieldset class="fieldset w-fit">
                                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_documento_tipo">Tipo de Documento:</label>
                                    <select id="create_estudiante_documento_tipo" name="estudiante_documento_tipo" class="select select-bordered w-fit">
                                        <option value="CC">Cédula de Ciudadanía</option>
                                        <option value="TI">Tarjeta de Identidad</option>
                                        <option value="CE">Cédula de Extranjería</option>
                                    </select>
                                </fieldset>
                                <fieldset class="w-full fieldset grow">
                                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_documento">Número de Documento:</label>
                                    <input id="create_estudiante_documento" name="estudiante_documento" class="input input-bordered w-full" placeholder="Documento del estudiante">
                                </fieldset>
                            </div>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_nacimiento">Fecha de Nacimiento:</label>
                                <input type="date" id="create_estudiante_nacimiento" name="estudiante_nacimiento" class="input input-bordered w-full">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_direccion">Dirección:</label>
                                <input id="create_estudiante_direccion" name="estudiante_direccion" class="input input-bordered w-full" placeholder="Dirección del estudiante">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_estudiante_contra">Contraseña:</label>
                                <input type="password" id="create_estudiante_contra" name="estudiante_contra" class="input input-bordered w-full" placeholder="Contraseña del estudiante">
                            </fieldset>
                        </div>
                    </div>
                </div>

                <!-- TUTOR -->
                <div class="card bg-base-100">
                    <div class="card-body">
                        <h4 class="card-title text-base">2. Datos del tutor</h4>
                        <div class="space-y-2">
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_nombre">Nombre:</label>
                                <input id="create_tutor_nombre" name="tutor_nombre" class="input input-bordered w-full" placeholder="Nombre del tutor">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_apellido">Apellido:</label>
                                <input id="create_tutor_apellido" name="tutor_apellido" class="input input-bordered w-full" placeholder="Apellido del tutor">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_correo">Correo:</label>
                                <input type="email" id="create_tutor_correo" name="tutor_correo" class="input input-bordered w-full" placeholder="Correo del tutor">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_telefono">Teléfono:</label>
                                <input type="number" id="create_tutor_telefono" name="tutor_telefono" class="input input-bordered w-full" placeholder="Teléfono del tutor">
                            </fieldset>
                            <div class="w-full flex gap-2">
                                <fieldset class="fieldset w-fit">
                                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_documento_tipo">Tipo de Documento:</label>
                                    <select id="create_tutor_documento_tipo" name="tutor_documento_tipo" class="select select-bordered w-fit">
                                        <option value="CC">Cédula de Ciudadanía</option>
                                        <option value="TI">Tarjeta de Identidad</option>
                                        <option value="CE">Cédula de Extranjería</option>
                                    </select>
                                </fieldset>
                                <fieldset class="w-full fieldset grow">
                                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_documento">Número de Documento:</label>
                                    <input id="create_tutor_documento" name="tutor_documento" class="input input-bordered w-full" placeholder="Documento del tutor">
                                </fieldset>
                            </div>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_nacimiento">Fecha de Nacimiento:</label>
                                <input type="date" id="create_tutor_nacimiento" name="tutor_nacimiento" class="input input-bordered w-full">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_direccion">Dirección:</label>
                                <input id="create_tutor_direccion" name="tutor_direccion" class="input input-bordered w-full" placeholder="Dirección del tutor">
                            </fieldset>
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_tutor_contra">Contraseña:</label>
                                <input type="password" id="create_tutor_contra" name="tutor_contra" class="input input-bordered w-full" placeholder="Contraseña del tutor">
                            </fieldset>
                        </div>
                    </div>
                </div>

                <!-- MATRÍCULA -->
                <div class="card bg-base-100">
                    <div class="card-body">
                        <h4 class="card-title text-base">3. Matrícula</h4>
                        <div class="space-y-2">
                            <fieldset class="w-full fieldset">
                                <label class="fieldset-label after:content-['*'] after:text-red-500" for="create_grupo_id">Grupo:</label>
                                <select name="grupo_id" id="create_grupo_id" class="select select-bordered w-full">
                                    <option disabled selected>Seleccione un grupo</option>
                                    @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->grupo_id }}" data-grado="{{ $grupo->grado->grado_id }}" data-año="{{ $grupo->grupo_año }}" data-cupo="{{ $grupo->grupo_cupo - $grupo->matriculas->count() }}">
                                        {{ $grupo->grupo_nombre }}:
                                        {{ $grupo->grupo_cupo - $grupo->matriculas->count() }} cupos disponibles
                                    </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" class="btn" onclick="document.getElementById('createEnrollModal').close()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Matricular</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Enroll old student Modal -->
    <dialog id="showEnrollModal" class="modal">
        <div class="modal-box max-w-4xl bg-base-200">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>

            <h3 class="text-lg font-bold mb-4">Proceso de Matrícula</h3>

            <form id="enrollForm" class="upload-form space-y-6" data-method="put" data-target="/api/enrollments-requests/{id}" data-debug="true" data-show-alert="true" data-reload="true">
                <input type="hidden" name="matricula_año" id="enroll_matricula_año" value="">
                <input type="hidden" name="institucion_id" id="enroll_institucion_id" value="{{ $institucion->institucion_id }}">
                <input type="hidden" name="estudiante_id" id="enroll_estudiante_id" value="">
                <input type="hidden" name="es_nuevo" id="enroll_es_nuevo" value="0">

                <!-- MATRÍCULA -->
                <div class="card bg-base-100">
                    <div class="card-body">
                        <h4 class="card-title text-base">Datos de la Matrícula</h4>
                        <fieldset class="w-full fieldset">
                            <label class="fieldset-label after:content-['*'] after:text-red-500" for="enroll_grupo_id">Salón:</label>
                            <select id="enroll_grupo_id" name="grupo_id" class="select select-bordered w-full">
                                <option disabled selected>Seleccione un grupo</option>
                                @forelse ($grupos as $grupo)
                                <option value="{{ $grupo->grupo_id }}" data-grado="{{ $grupo->grado->grado_id }}" data-año="{{ $grupo->grupo_año }}" data-cupo="{{ $grupo->grupo_cupo - $grupo->matriculas->count() }}">
                                    {{ $grupo->grupo_nombre }}: {{ $grupo->grupo_cupo - $grupo->matriculas->count() }} cupos disponibles
                                </option>
                                @empty
                                <option disabled>No hay grupos disponibles</option>
                                @endforelse
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" class="btn" onclick="document.getElementById('showEnrollModal').close()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Matricular</button>
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
<script>
    function showDetails(id, requestJSONString) {
        const request = JSON.parse(requestJSONString);
        const $modal = document.getElementById('detailsModal');

        const cupoCursos = request.grado.grupos.reduce((acc, grupo) => acc + parseInt(grupo.grupo_cupo) - parseInt(grupo.matriculas.length), 0);

        // Información general
        document.getElementById('solicitud_id').textContent = request.solicitud_id.split('-')[0];
        document.getElementById('grado_nombre').textContent = request.grado.grado_nombre + ' ' + request.solicitud_año + ' (' + cupoCursos + ' cupos disponibles)';
        document.getElementById('solicitud_estado').textContent = request.solicitud_estado;
        document.getElementById('solicitud_comentario').textContent = request.solicitud_comentario || 'Sin comentarios';

        // Datos del estudiante
        const esEstudianteExistente = request.estudiante ? 'Sí' : 'No';
        document.getElementById('es_estudiante_existente').textContent = esEstudianteExistente;

        if (request.estudiante) {
            document.getElementById('estudiante_nombre').textContent =
                `${request.estudiante.usuario.usuario_nombre} ${request.estudiante.usuario.usuario_apellido}`;
            document.getElementById('estudiante_documento').textContent =
                `${request.estudiante.usuario.usuario_documento_tipo}: ${request.estudiante.usuario.usuario_documento}`;
            document.getElementById('estudiante_nacimiento').textContent = new Date(request.estudiante.usuario.usuario_nacimiento).toLocaleDateString("es-CO", {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Mostrar matrícula actual si existe
            const matriculaActual = request.estudiante.matriculas?.find(m => m.matricula_año === new Date().getFullYear());
            if (matriculaActual) {
                document.getElementById('matricula_actual').textContent =
                    `${matriculaActual.grupo.grado.grado_nombre} - ${matriculaActual.grupo.grupo_nombre}`;
                document.getElementById('matricula_actual_container').classList.remove('hidden');
            } else {
                document.getElementById('matricula_actual_container').classList.add('hidden');
            }
        } else {
            document.getElementById('estudiante_nombre').textContent =
                `${request.estudiante_nuevo.estudiante_nombre} ${request.estudiante_nuevo.estudiante_apellido}`;
            document.getElementById('estudiante_documento').textContent =
                `${request.estudiante_nuevo.estudiante_documento_tipo}: ${request.estudiante_nuevo.estudiante_documento}`;
            document.getElementById('estudiante_nacimiento').textContent = new Date(request.estudiante_nuevo.estudiante_nacimiento).toLocaleDateString("es-CO", {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('matricula_actual_container').classList.add('hidden');
        }

        // Datos del tutor
        document.getElementById('tutor_nombre').textContent =
            `${request.tutor_nuevo.tutor_nombre} ${request.tutor_nuevo.tutor_apellido}`;
        document.getElementById('tutor_documento').textContent =
            `${request.tutor_nuevo.tutor_documento_tipo}: ${request.tutor_nuevo.tutor_documento}`;
        document.getElementById('tutor_telefono').textContent = request.tutor_nuevo.tutor_telefono;
        document.getElementById('tutor_correo').href = `mailto:${request.tutor_nuevo.tutor_correo}`;
        document.getElementById('tutor_correo').textContent = request.tutor_nuevo.tutor_correo;
        document.getElementById('tutor_direccion').textContent = request.tutor_nuevo.tutor_direccion;

        $modal.show();
    }

    function showCreateModal(id, requestJSONString) {
        const request = JSON.parse(requestJSONString);
        const $modal = document.getElementById('createEnrollModal');

        document.getElementById('create_matricula_año').value = request.solicitud_año;
        document.getElementById('create_institucion_id').value = request.institucion_id;
        document.getElementById('create_es_nuevo').value = request.estudiante ? '0' : '1';

        // Datos del estudiante
        document.getElementById('create_estudiante_nombre').value = request.estudiante_nuevo.estudiante_nombre;
        document.getElementById('create_estudiante_apellido').value = request.estudiante_nuevo.estudiante_apellido;
        document.getElementById('create_estudiante_documento_tipo').value = request.estudiante_nuevo.estudiante_documento_tipo;
        document.getElementById('create_estudiante_documento').value = request.estudiante_nuevo.estudiante_documento;
        document.getElementById('create_estudiante_nacimiento').value = request.estudiante_nuevo.estudiante_nacimiento;
        document.getElementById('create_estudiante_direccion').value = request.tutor_nuevo.tutor_direccion;

        // Datos del tutor
        document.getElementById('create_tutor_nombre').value = request.tutor_nuevo.tutor_nombre;
        document.getElementById('create_tutor_apellido').value = request.tutor_nuevo.tutor_apellido;
        document.getElementById('create_tutor_documento_tipo').value = request.tutor_nuevo.tutor_documento_tipo;
        document.getElementById('create_tutor_documento').value = request.tutor_nuevo.tutor_documento;
        document.getElementById('create_tutor_nacimiento').value = request.tutor_nuevo.tutor_nacimiento;
        document.getElementById('create_tutor_direccion').value = request.tutor_nuevo.tutor_direccion;
        document.getElementById('create_tutor_telefono').value = request.tutor_nuevo.tutor_telefono;
        document.getElementById('create_tutor_correo').value = request.tutor_nuevo.tutor_correo;

        // Matrícula
        document.querySelectorAll('option[data-grado]').forEach(option => {
            if (option.dataset.grado == request.grado.grado_id && option.dataset.año == request.solicitud_año && option.dataset.cupo > 0) {
                option.classList.remove('hidden');
            } else {
                option.classList.add('hidden');
            }
        });

        const $form = document.getElementById('matriculaForm');
        $form.dataset.target = $form.dataset.target.replace('{id}', id);

        $modal.show();
    }

    function showEnrollModal(id, requestJSONString) {
        const request = JSON.parse(requestJSONString);
        const $modal = document.getElementById('showEnrollModal');

        // Set hidden fields
        document.getElementById('enroll_matricula_año').value = request.solicitud_año;
        document.getElementById('enroll_estudiante_id').value = request.estudiante.estudiante_id;
        document.getElementById('enroll_institucion_id').value = request.institucion_id;
        document.getElementById('enroll_es_nuevo').value = request.estudiante ? '0' : '1';

        // Filter groups based on grade and year
        document.querySelectorAll('#enroll_grupo_id option[data-grado]').forEach(option => {
            if (option.dataset.grado == request.grado.grado_id &&
                option.dataset.año == request.solicitud_año &&
                option.dataset.cupo > 0) {
                option.classList.remove('hidden');
            } else {
                option.classList.add('hidden');
            }
        });

        // Update form target
        const $form = document.getElementById('enrollForm');
        $form.dataset.target = $form.dataset.target.replace('{id}', id);

        $modal.show();
    }
</script>
@endsection