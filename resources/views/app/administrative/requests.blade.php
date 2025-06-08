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
                                    <button onclick="showEnrollModal('{{ $solicitud->solicitud_id }}')" class="btn btn-sm py-1 btn-primary">
                                        Renovar matrícula
                                    </button>
                                    @else
                                    <button onclick="showCreateModal('{{ $solicitud->solicitud_id }}')" class="btn btn-sm py-1 btn-primary">
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

    <!-- Enrollment Modal -->
    <div id="enrollModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Content will be loaded dynamically -->
                <form action="" class="upload-form space-y-5" data-method="put" data-target="/api/enrollments-requests/{{ $solicitud->solicitud_id }}" data-show-alert="true" data-reload="true">
                    <!-- Create Tutor Form -->

                    <!-- Create Student Form -->

                    <!-- Assign enrollment -->

                </form>
                <div class="mt-4 flex justify-end space-x-3">
                    <button onclick="closeEnrollModal()" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                        Cancelar
                    </button>
                    <button onclick="enrollStudent()" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function showDetails(id, requestJSONString) {
        const request = JSON.parse(requestJSONString);
        const modal = document.getElementById('detailsModal');

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

        modal.showModal();
    }
</script>
@endsection