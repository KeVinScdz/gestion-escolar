@extends('layouts.app')

@section('title', 'Editar Institución')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <div class="w-full p-6 rounded-lg bg-base-200 border border-base-300">

            <h2 class="text-xl font-semibold">Información de la Institución</h2>

            <form data-target="/api/institutions/{{ $institucion->institucion_id }}" data-method="put" data-show-alert="true" data-reload="true" class="upload-form space-y-4">
                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_nombre">Nombre de la Institución:</label>
                    <input id="institucion_nombre" name="institucion_nombre" type="text" class="input input-bordered w-full" value="{{ old('institucion_nombre', $institucion->institucion_nombre ?? '') }}" required>
                </fieldset>

                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_telefono">Teléfono:</label>
                    <input id="institucion_telefono" name="institucion_telefono" type="tel" class="input input-bordered w-full" value="{{ old('institucion_telefono', $institucion->institucion_telefono ?? '') }}" required>
                </fieldset>

                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_correo">Correo Electrónico:</label>
                    <input id="institucion_correo" name="institucion_correo" type="email" class="input input-bordered w-full" value="{{ old('institucion_correo', $institucion->institucion_correo ?? '') }}" required>
                </fieldset>

                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_direccion">Dirección:</label>
                    <input id="institucion_direccion" name="institucion_direccion" type="text" class="input input-bordered w-full" value="{{ old('institucion_direccion', $institucion->institucion_direccion ?? '') }}" required>
                </fieldset>

                <fieldset class="w-full fieldset">
                    <label class="fieldset-label after:content-['*'] after:text-red-500" for="institucion_nit">NIT:</label>
                    <input id="institucion_nit" name="institucion_nit" type="text" class="input input-bordered w-full" value="{{ old('institucion_nit', $institucion->institucion_nit ?? '') }}" required>
                </fieldset>

                <div class="flex justify-end space-x-2 pt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection