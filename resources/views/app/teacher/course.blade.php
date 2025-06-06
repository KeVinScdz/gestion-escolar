@extends('layouts.app')
@section('title', 'Gestión de Curso')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-5">
        <div class="space-y-4">
            {{-- Título principal --}}
            <h1 class="text-3xl font-bold">
                {{ $asignacion->materia->materia_nombre }} - Grupo {{ $asignacion->grupo->grupo_nombre }}
            </h1>

            {{-- Encabezado y total estudiantes --}}
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Estudiantes</h2>
                    <p class="text-sm text-base-content/60">Total registrados: <span class="font-medium">{{ $estudiantes->count() }}</span></p>
                </div>
            </div>
        </div>

        {{-- Botones de acciones principales --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <button onclick="document.getElementById('create-list-modal').show()" class="btn btn-primary transition hover:scale-105">
                <i class="fas fa-clipboard-list"></i>
                Llamar a lista
            </button>

            <button onclick="document.getElementById('create-observation-modal').show()" class="btn btn-warning transition hover:scale-105">
                <i class="fas fa-comment-medical"></i>
                Agregar observación
            </button>

            <a href="/dashboard/docente/cursos/{{ $asignacion->asignacion_id }}?accion=notas" class="btn btn-accent transition hover:scale-105">
                <i class="fas fa-pen-alt"></i>
                Gestionar notas
            </a>
        </div>
    </div>
</section>

@if(request('accion') === 'lista')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-5">
        <h2 class="text-2xl font-semibold">Lista de Estudiantes</h2>
        <form class="upload-form space-y-5" data-target="/api/attendances" data-method="post" data-reload="true" data-show-alert="true">
            <input type="hidden" name="asignacion_id" value="{{ $asignacion->asignacion_id }}">
            <input type="hidden" name="asistencia_fecha" value="{{ request('asistencia_fecha') }}">

            <div class="bg-base-200 border border-base-300 rounded-lg">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Contacto tutor</th>
                                <th>Asistió</th>
                                <th>Justificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantes as $estudiante)
                            @php
                            $asistencia = $asistencias->where('matricula_id', $estudiante->matriculas->last()->matricula_id)
                            ->where('asistencia_fecha', request('asistencia_fecha'))
                            ->first();
                            @endphp
                            <input type="hidden" name="matriculas[]" value="{{ $estudiante->matriculas->last()->matricula_id }}">
                            <tr>
                                <td>{{ $estudiante->usuario->usuario_documento_tipo }}: {{ $estudiante->usuario->usuario_documento }}</td>
                                <td>
                                    <a href="/dashboard/estudiantes/{{ $estudiante->estudiante_id }}" target="_blank" class="hover:text-primary hover:underline tooltip" data-tip="Ver perfil">
                                        {{ $estudiante->usuario->usuario_apellido }} {{ $estudiante->usuario->usuario_nombre }}
                                    </a>
                                </td>
                                <td>
                                    @if($estudiante->tutor)
                                    <a href="mailto:{{ $estudiante->tutor->usuario->usuario_correo }}" target="_blank" class="text-primary hover:underline tooltip" data-tip="Enviar correo al tutor">
                                        {{ $estudiante->tutor->usuario->usuario_correo }}
                                    </a>
                                    <span class="text-base-content/60">({{ $estudiante->tutor->usuario->usuario_telefono }})</span>
                                    @else
                                    <span class="text-base-content/60">No asignado</span>
                                    @endif
                                </td>
                                <td>
                                    <select name="asistencias_estados[]" class="select select-bordered" required>
                                        <option value="" disabled {{ $asistencia ? '' : 'selected' }}>Seleccionar estado</option>
                                        <option value="presente" {{ $asistencia ? ($asistencia->asistencia_estado === 'presente' ? 'selected' : '') : '' }}>Presente</option>
                                        <option value="ausente" {{ $asistencia ? ($asistencia->asistencia_estado === 'ausente' ? 'selected' : '') : '' }}>Ausente</option>
                                        <option value="retardo" {{ $asistencia ? ($asistencia->asistencia_estado === 'retardo' ? 'selected' : '') : '' }}>retardo</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="justificaciones[]" class="input input-bordered w-full" placeholder="Justificación (opcional)" value="{{ $asistencia ? $asistencia->asistencia_motivo : '' }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-5">
                <a href="/dashboard/docente/cursos/{{ $asignacion->asignacion_id }}" type="button" class="btn btn-error hover:scale-105 transition">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success hover:scale-105 transition">
                    <i class="fas fa-save"></i>
                    {{ $asistencias->isEmpty() ? 'Registrar asistencia' : 'Actualizar asistencia' }}
                </button>
            </div>
        </form>
    </div>
</section>
@elseif (request('accion') === 'notas')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div>
            <h2 class="text-2xl font-semibold">Gestión de Notas</h2>
            <p class="text-base-content/60">Aquí puedes gestionar las notas de los estudiantes del curso.</p>
        </div>
        <form class="upload-form space-y-5" data-target="/api/grades" data-method="post" data-reload="true" data-show-alert="true" data-debug="true">
            <input type="hidden" name="asignacion_id" value="{{ $asignacion->asignacion_id }}">

            <div class="w-full overflow-x-auto bg-base-200 border border-base-300 rounded-lg">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            @foreach ($periodos as $periodo)
                            <th>{{ $periodo->periodo_academico_nombre }}</th>
                            @endforeach
                            <th>Promedio (Mínimo {{ $institucion->nota_aprobatoria }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantes as $estudiante)
                        @php
                        $notasEstudiante = $notas->where('matricula_id', $estudiante->matriculas->last()->matricula_id);
                        $promedio = $notasEstudiante->avg('nota_valor');
                        $promedio = isset($promedio) ? number_format($promedio, 2) : 'N/A';

                        $periodosTotales = count($periodos);
                        $restantes = $periodosTotales - $notasEstudiante->count();
                        $notaNecesaria = $restantes > 0 ? (($institucion->nota_aprobatoria * $periodosTotales) - $notasEstudiante->sum('nota_valor')) / $restantes : 9999;
                        @endphp
                        <tr>
                            <td>
                                <a href="/dashboard/estudiantes/{{ $estudiante->estudiante_id }}" target="_blank" class="hover:text-primary hover:underline tooltip" data-tip="Ver perfil">
                                    {{ $estudiante->usuario->usuario_apellido }} {{ $estudiante->usuario->usuario_nombre }}
                                </a>
                            </td>
                            @foreach ($periodos as $index => $periodo)
                            <input type="hidden" name="matriculas[]" value="{{ $estudiante->matriculas->last()->matricula_id }}">
                            <input type="hidden" name="periodos[]" value="{{ $periodo->periodo_academico_id }}">
                            <td>
                                <input
                                    type="number"
                                    name="notas[]"
                                    class="input input-bordered w-full"
                                    placeholder="Nota ({{ $institucion->nota_minima}}-{{ $institucion->nota_maxima }})"
                                    value="{{ $notasEstudiante->where('periodo_academico_id', $periodo->periodo_academico_id)->first()->nota_valor ?? '' }}"
                                    step="0.01"
                                    min="0"
                                    max="100">
                            </td>
                            @endforeach
                            <td>
                                <div class="flex gap-2 items-center">
                                    <input
                                        type="text"
                                        name="promedios[]"
                                        class="input input-bordered w-20 {{ count($notasEstudiante) > 0 ? ($institucion->nota_aprobatoria > $promedio ? 'input-error' : 'input-success') : '' }}"
                                        value="{{ $promedio }}"
                                        readonly>

                                    @if(count($notasEstudiante) > 0)
                                    @if($institucion->nota_aprobatoria > $promedio)
                                    <span class="text-error tooltip tooltip-left" data-tip="El estudiante no ha alcanzado la nota mínima aprobatoria ({{ $institucion->nota_aprobatoria }}).
                                    @if($notaNecesaria && $notaNecesaria > $institucion->nota_maxima)
                                        El estudiante ya no puede alcanzar la nota mínima aprobatoria.
                                    @elseif($notaNecesaria && $notaNecesaria > 0)
                                        Necesita al menos {{ number_format($notaNecesaria, 2) }} en cada periodo restante.
                                    @endif
                                    ">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>

                                    @else
                                    <span class="text-success tooltip tooltip-left" data-tip="El promedio del estudiente es mayor o igual a la nota aprobatoria.">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                    @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end gap-4 mt-5">
                <a href="/dashboard/docente/cursos/{{ $asignacion->asignacion_id }}" type="button" class="btn btn-error hover:scale-105 transition">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success hover:scale-105 transition">
                    <i class="fas fa-save"></i>
                    {{ $notas->isEmpty() ? 'Registrar notas' : 'Actualizar notas' }}
                </button>
            </div>
        </form>
    </div>
</section>
@else
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-5">
        <div>
            <h2 class="text-2xl font-semibold">Observaciones de Estudiantes</h2>
            <p class="text-base-content/60">Aquí puedes ver y gestionar las observaciones de los estudiantes.</p>
        </div>
        <div class="w-full overflow-x-auto bg-base-200 border border-base-300 rounded-lg">

            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @foreach($observaciones as $observacion)
                <tr>
                    <td>
                        <a href="/dashboard/estudiantes/{{ $observacion->matricula->estudiante_id }}" target="_blank" class="hover:text-primary hover:underline tooltip" data-tip="Ver perfil">
                            {{ $observacion->matricula->estudiante->usuario->usuario_apellido }} {{ $observacion->matricula->estudiante->usuario->usuario_nombre }}
                        </a>
                    </td>
                    <td>{{ $observacion->observacion_fecha }}</td>
                    <td>{{ $observacion->observacion_tipo }}</td>
                    <td>{{ $observacion->observacion_descripcion }}</td>
                    <td>
                        <div class="flex flex-wrap gap-4">
                            <button onclick="openEditObservationModal('{{ $observacion->observacion_id }}', '{{ json_encode($observacion) }}')" class="btn btn-sm py-1.5 btn-primary">
                                <i class="fas fa-edit"></i>
                                Editar
                            </button>
                            <button onclick="deleteObservation('{{ $observacion->observacion_id }}')" class="btn btn-sm py-1.5 btn-error">
                                <i class="fas fa-trash"></i>
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</section>
@endif

<!-- Create List Modal -->
<dialog id="create-list-modal" class="modal">
    <div class="modal-box space-y-5">
        <h2 class="text-xl font-semibold">Llamar a lista</h2>
        <p class="text-base-content/60">Marca los estudiantes que asistieron a la clase.</p>
        <form method="get">
            <input type="hidden" name="accion" value="lista">
            <fieldset class="fieldset">
                <label class="fieldset-label after:content-['(formato:_MM/DD/YYYY)'] after:text-base-content/60" for="asistencia_fecha">
                    Fecha de la clase:
                </label>
                <input type="date" id="asistencia_fecha" name="asistencia_fecha" class="input" required value="{{ date('Y-m-d') }}">
            </fieldset>

            <div class="flex gap-2 justify-end mt-4">
                <button type="button" onclick="document.getElementById('create-list-modal').close()" class="btn">Cancelar</button>
                <button type="submit" class="btn btn-primary">Llamar lista</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>Cerrar</button>
    </form>
</dialog>

<!-- Create Observation Modal -->
<dialog id="create-observation-modal" class="modal">
    <div class="modal-box space-y-5">
        <h2 class="text-xl font-semibold">Agregar Observación</h2>

        <form class="upload-form space-y-4" data-target="/api/observations" data-method="post" data-reload="true" data-show-alert="true">
            <fieldset class="fieldset">
                <label class="fieldset-label" for="observacion_fecha">
                    Fecha:
                </label>
                <input type="date" id="observacion_fecha" name="observacion_fecha" class="input" value="{{ date('Y-m-d') }}">
            </fieldset>

            <fieldset class="fieldset">
                <label class="fieldset-label" for="observacion_tipo">
                    Tipo de observación:
                </label>
                <select name="observacion_tipo" id="observacion_tipo" class="select select-bordered">
                    <!-- Academicas -->
                    <optgroup label="Académicas">
                        <option value="bajo rendimiento">Bajo rendimiento</option>
                        <option value="falta de participación">Falta de participación</option>
                        <option value="inconvenientes con tareas">Inconvenientes con tareas</option>
                    </optgroup>

                    <!-- Disciplinarias -->
                    <optgroup label="Disciplinarias">
                        <option value="faltas de respeto">Faltas de respeto</option>
                        <option value="incumplimiento de normas">Incumplimiento de normas</option>
                        <option value="problemas de convivencia">Problemas de convivencia</option>
                        <option value="comportamiento ejemplar">Comportamiento ejemplar</option>
                        <option value="llamado de atención">Llamado de atención</option>
                    </optgroup>

                    <!-- Otros -->
                    <optgroup label="Otros">
                        <option value="observación general">Observación general</option>
                        <option value="salud o bienestar">Salud o bienestar</option>
                        <option value="asistencia irregular">Asistencia irregular</option>
                    </optgroup>
                </select>
            </fieldset>

            <fieldset class="fieldset">
                <label class="fieldset-label" for="matricula_id">
                    Estudiante:
                </label>
                <select name="matricula_id" id="matricula_id" class="select select-bordered">
                    @foreach ($estudiantes as $estudiante)
                    <option value="{{ $estudiante->matriculas->last()->matricula_id }}">
                        {{ $estudiante->usuario->usuario_nombre }} {{ $estudiante->usuario->usuario_apellido }}
                    </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="fieldset">
                <label class="fieldset-label" for="observacion_descripcion">
                    Descripción:
                </label>
                <textarea id="observacion_descripcion" name="observacion_descripcion" rows="4" class="textarea" placeholder="Escribe aquí la observación..."></textarea>
            </fieldset>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="document.getElementById('create-observation-modal').close()" class="btn">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>Cerrar</button>
    </form>
</dialog>

<!-- Edit Observation Modal -->
<dialog id="edit-observation-modal" class="modal">
    <div class="modal-box space-y-5">
        <h2 class="text-xl font-semibold">Editar Observación</h2>

        <form class="upload-form space-y-4" data-target="/api/observations/{id}" data-method="put" data-reload="true" data-show-alert="true">
            <fieldset class="fieldset">
                <label class="fieldset-label" for="observacion_fecha">
                    Fecha:
                </label>
                <input type="date" id="observacion_fecha" name="observacion_fecha" class="input">
            </fieldset>

            <fieldset class="fieldset">
                <label class="fieldset-label" for="observacion_tipo">
                    Tipo de observación:
                </label>
                <select name="observacion_tipo" id="observacion_tipo" class="select select-bordered">
                    <!-- Academicas -->
                    <optgroup label="Académicas">
                        <option value="bajo rendimiento">Bajo rendimiento</option>
                        <option value="falta de participación">Falta de participación</option>
                        <option value="inconvenientes con tareas">Inconvenientes con tareas</option>
                    </optgroup>

                    <!-- Disciplinarias -->
                    <optgroup label="Disciplinarias">
                        <option value="faltas de respeto">Faltas de respeto</option>
                        <option value="incumplimiento de normas">Incumplimiento de normas</option>
                        <option value="problemas de convivencia">Problemas de convivencia</option>
                        <option value="comportamiento ejemplar">Comportamiento ejemplar</option>
                        <option value="llamado de atención">Llamado de atención</option>
                    </optgroup>

                    <!-- Otros -->
                    <optgroup label="Otros">
                        <option value="observación general">Observación general</option>
                        <option value="salud o bienestar">Salud o bienestar</option>
                        <option value="asistencia irregular">Asistencia irregular</option>
                    </optgroup>
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <label class="fieldset-label" for="observacion_descripcion">
                    Descripción:
                </label>
                <textarea id="observacion_descripcion" name="observacion_descripcion" rows="4" class="textarea" placeholder="Escribe aquí la observación..."></textarea>
            </fieldset>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="document.getElementById('edit-observation-modal').close()" class="btn">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>Cerrar</button>
    </form>
</dialog>

<form id="delete-observation-form" class="upload-form hidden" data-target="/api/observations/{id}" data-method="delete" data-reload="true" data-show-alert="true">
    <button type="submit">Eliminar</button>
</form>
@endsection

@section('scripts')
<script>
    function openEditObservationModal(observationId, observationJSONString) {
        const observation = JSON.parse(observationJSONString);
        const $modal = document.getElementById('edit-observation-modal');

        $modal.querySelector('form').dataset.target = `/api/observations/${observationId}`;

        $modal.querySelector('input[name="observacion_fecha"]').value = observation.observacion_fecha;
        $modal.querySelector('select[name="observacion_tipo"]').value = observation.observacion_tipo;
        $modal.querySelector('textarea[name="observacion_descripcion"]').value = observation.observacion_descripcion;

        $modal.show();
    }

    function deleteObservation(observationId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Estaacción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (!result.isConfirmed) return;

            const $deleteForm = document.getElementById('delete-observation-form');
            $deleteForm.dataset.target = `/api/observations/${observationId}`;

            $deleteForm.querySelector('button').click();
        });
    }
</script>
@endsection