@extends('layouts.guest')

@section('title', 'Matricular')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto min-h-screen py-15">
        <div class="w-full flex flex-col items-center gap-10 py-10">
            <div class="space-y-5">
                <div>
                    <p class="text-primary text-lg font-bold uppercase tracking-wider">¡Bienvenido a MATRYERSE!</p>
                    <h2 class="text-4xl font-bold">Solicitud de Matrícula</h2>
                </div>
                <p class="text-base-content/70 text-lg leading-relaxed">
                    Completa este formulario para registrar a tu hijo o acudido en la institución de tu preferencia.
                    Una vez enviada la solicitud, el equipo administrativo revisará la información y se pondrá en contacto contigo para continuar con el proceso de matrícula.
                </p>
            </div>

            <div class="w-full bg-base-200 border border-base-300 rounded-lg p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
                <form id="enrollForm" class="upload-form space-y-6 w-full" data-debug="true" data-method="POST" data-target="/api/enrollments-requests" data-show-alert="true" data-reset="true">
                    <h3 class="text-lg font-semibold text-base-content">Información del Tutor</h3>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Nombre</label>
                        <input type="text" name="tutor_nombre" class="input input-bordered w-full" required>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Apellido</label>
                        <input type="text" name="tutor_apellido" class="input input-bordered w-full" required>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Tipo de documento</label>
                        <select name="tutor_documento_tipo" class="select select-bordered w-full" required>
                            <option value="CC">Cédula</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Número de documento</label>
                        <input type="text" name="tutor_documento" class="input input-bordered w-full" required>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Correo electrónico</label>
                        <input type="email" name="tutor_correo" class="input input-bordered w-full" required>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Teléfono</label>
                        <input type="text" name="tutor_telefono" class="input input-bordered w-full" required>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Dirección</label>
                        <input type="text" name="tutor_direccion" class="input input-bordered w-full" required>
                    </fieldset>

                    <h3 class="text-lg font-semibold text-base-content pt-6">Información del Estudiante</h3>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">¿El estudiante ya está registrado?</label>
                        <select name="estudiante_existente" id="estudiante_existente" class="select select-bordered w-full" required onchange="toggleCamposEstudiante(this)">
                            <option value="no">No, es nuevo</option>
                            <option value="si">Sí, ya está registrado</option>
                        </select>
                    </fieldset>

                    <div id="campos-estudiante-nuevo" class="space-y-4">
                        <fieldset class="fieldset">
                            <label class="fieldset-label">Nombre</label>
                            <input type="text" name="estudiante_nombre" class="input input-bordered w-full">
                        </fieldset>

                        <fieldset class="fieldset">
                            <label class="fieldset-label">Apellido</label>
                            <input type="text" name="estudiante_apellido" class="input input-bordered w-full">
                        </fieldset>

                        <fieldset class="fieldset">
                            <label class="fieldset-label">Tipo de documento</label>
                            <select name="estudiante_documento_tipo" class="select select-bordered w-full">
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CC">Cédula</option>
                                <option value="CE">Cédula de Extranjería</option>
                            </select>
                        </fieldset>

                        <fieldset class="fieldset">
                            <label class="fieldset-label">Número de documento</label>
                            <input type="text" name="estudiante_documento" class="input input-bordered w-full">
                        </fieldset>

                        <fieldset class="fieldset">
                            <label class="fieldset-label">Fecha de nacimiento</label>
                            <input type="date" name="estudiante_nacimiento" class="input input-bordered w-full">
                        </fieldset>
                    </div>

                    <div id="campos-estudiante-registrado" class="space-y-4 hidden">
                        <fieldset class="fieldset">
                            <label class="fieldset-label">Número de documento del estudiante</label>
                            <input type="text" name="estudiante_documento_existente" class="input input-bordered w-full">
                        </fieldset>
                    </div>

                    <h3 class="text-lg font-semibold text-base-content pt-6">Institución</h3>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Seleccione una institución</label>
                        <select name="institucion_id" class="select select-bordered w-full" required onchange="cambiarGrado(this)">
                            @foreach($grupos as $institucion_id => $grupos)
                            @php
                                $institucion = $grupos->first()->institucion;
                                $cupos = $grupos->sum('grupo_cupo');
                            @endphp 
                            <option value="{{ $institucion_id }}">{{ $institucion->institucion_nombre }} - ({{ $cupos }} cupos disponibles)</option>
                            @endforeach
                        </select>
                    </fieldset>
                    <h3 class="text-lg font-semibold text-base-content pt-6">Grado</h3>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Año</label>
                        <select name="solicitud_año" id="solicitud_año" class="select select-bordered w-full" required>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Grado</label>
                        <select name="grado_id" id="grado_id" class="select select-bordered w-full" required>
                            @foreach($grupos->groupBy('grado_id') as $grado_id => $grupos)
                            @php
                                $grado = $grupos->first()->grado;
                                $cupos = $grupos->sum('grupo_cupo');
                                $numeroCursos = $grupos->count();
                            @endphp 
                            <option value="{{ $grado->grado_id }}" data-institucion="{{ $grado->institucion_id }}">
                                {{ $grado->grado_nombre }} - ({{ $numeroCursos }} cursos) - ({{ $cupos }} cupos disponibles)
                            </option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label class="fieldset-label">Comentarios u observaciones</label>
                        <textarea name="solicitud_comentario" rows="3" class="textarea textarea-bordered w-full" placeholder="Opcional"></textarea>
                    </fieldset>

                    <button type="submit" class="btn btn-primary w-full">Enviar solicitud</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function toggleCamposEstudiante(select) {
        const nuevo = document.getElementById('campos-estudiante-nuevo');
        const registrado = document.getElementById('campos-estudiante-registrado');

        if (select.value === 'si') {
            nuevo.classList.add('hidden');
            registrado.classList.remove('hidden');
        } else {
            nuevo.classList.remove('hidden');
            registrado.classList.add('hidden');
        }
    }

    function cambiarGrado(select) {
        const gradoId = select.value;
        const gradoSelect = document.getElementById('grado_id');
        
        const options = gradoSelect.querySelectorAll('option');
        options.forEach(option => {
            if (option.dataset.institucion !== select.value) {
                option.classList.add('hidden');
            } else {
                option.classList.remove('hidden');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const estudianteExistente = document.getElementById('estudiante_existente');
        if (estudianteExistente) {
            toggleCamposEstudiante(estudianteExistente);
        }
    });
</script>
@endsection