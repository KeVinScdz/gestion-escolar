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
                        <!-- type select -->
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
                                    <button class="btn py-1 btn-primary" onclick="/* Lógica para eliminar */">Editar</button>
                                    <button class="btn py-1 btn-error" onclick="/* Lógica para eliminar */">Eliminar</button>
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
@endsection