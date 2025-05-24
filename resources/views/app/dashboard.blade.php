@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto py-10">

        <h1 class="text-2xl font-bold">Bienvenido, {{ $usuario->usuario_nombre }}</h1>

        <!-- Información del Usuario -->
        <div class="card bg-base-100 shadow-lg p-4">
            <h2 class="text-xl font-semibold mb-2">Información del Usuario</h2>
            <p><strong>Correo:</strong> {{ $usuario->usuario_correo }}</p>
            <p><strong>Rol:</strong> {{ $usuario->rol->rol_nombre }}</p>
        </div>

        <!-- Información Personal -->
        <div class="card bg-base-100 shadow-lg p-4">
            <h2 class="text-xl font-semibold mb-2">Información Personal</h2>
            <p><strong>Nombre:</strong> {{ $usuario->usuario_nombre }}</p>
            <p><strong>Apellido:</strong> {{ $usuario->usuario_apellido }}</p>
            <p><strong>Documento:</strong> {{ $usuario->usuario_documento }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $usuario->usuario_fecha_nacimiento }}</p>
            <p><strong>Teléfono:</strong> {{ $usuario->usuario_telefono }}</p>
            <p><strong>Dirección:</strong> {{ $usuario->usuario_direccion }}</p>
        </div>

        <!-- Formulario de Actualización -->
        <div class="collapse collapse-arrow bg-base-200 rounded-box">
            <input type="checkbox" />
            <div class="collapse-title text-lg font-medium">
                Actualizar Información Personal
            </div>
            <div class="collapse-content">
                <form action="/user/{{ $usuario->usuario_id }}" method="PUT" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <fieldset class="fieldset border border-base-300 p-4 rounded-box">
                        <legend class="fieldset-legend text-lg font-semibold mb-4">Datos Personales</legend>

                        <label class="label" for="usuario_nombre">Nombre</label>
                        <input type="text" id="usuario_nombre" name="usuario_nombre" class="input input-bordered w-full" value="{{ $usuario->usuario_nombre }}" required>

                        <label class="label" for="usuario_apellido">Apellido</label>
                        <input type="text" id="usuario_apellido" name="usuario_apellido" class="input input-bordered w-full" value="{{ $usuario->usuario_apellido }}" required>

                        <label class="label" for="usuario_documento">Documento</label>
                        <input type="text" id="usuario_documento" name="usuario_documento" class="input input-bordered w-full" value="{{ $usuario->usuario_documento }}" required>

                        <label class="label" for="usuario_fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="usuario_fecha_nacimiento" name="usuario_fecha_nacimiento" class="input input-bordered w-full" value="{{ $usuario->usuario_fecha_nacimiento }}" required>

                        <label class="label" for="usuario_telefono">Teléfono</label>
                        <input type="text" id="usuario_telefono" name="usuario_telefono" class="input input-bordered w-full" value="{{ $usuario->usuario_telefono }}" required>

                        <label class="label" for="usuario_direccion">Dirección</label>
                        <input type="text" id="usuario_direccion" name="usuario_direccion" class="input input-bordered w-full" value="{{ $usuario->usuario_direccion }}" required>

                        <button type="submit" class="btn btn-primary mt-4">Actualizar</button>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection