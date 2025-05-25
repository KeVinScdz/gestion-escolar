@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-2xl font-bold">Bienvenido, {{ $usuario->usuario_nombre }}</h1>

        <!-- Información del Usuario -->
        <div class="card bg-base-200 border border-base-300 p-4">
            <h2 class="text-xl font-semibold mb-2">Información del Usuario</h2>
            <p><strong>Correo:</strong> {{ $usuario->usuario_correo }}</p>
            <p><strong>Rol:</strong> {{ $usuario->rol->rol_nombre }}</p>
            <p><strong>Nombre:</strong> {{ $usuario->usuario_nombre }}</p>
            <p><strong>Apellido:</strong> {{ $usuario->usuario_apellido }}</p>
            <p><strong>Documento:</strong> {{ $usuario->usuario_documento_tipo }} {{ $usuario->usuario_documento }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $usuario->usuario_nacimiento }}</p>
            <p><strong>Teléfono:</strong> {{ $usuario->usuario_telefono }}</p>
            <p><strong>Dirección:</strong> {{ $usuario->usuario_direccion }}</p>
        </div>

        <!-- Formulario de Actualización -->
        <div class="collapse bg-base-200 border border-base-300 rounded-box">
            <input type="checkbox" checked disabled readonly />
            <div class="collapse-title text-lg font-medium">
                Actualizar Información Personal
            </div>
            <div class="collapse-content">
                <form
                    data-target="/api/users/{{ $usuario->usuario_id }}"
                    data-method="PUT"
                    data-show-alert="true"
                    data-reload="true"
                    class="upload-form space-y-2">
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_nombre">Nombre</label>
                        <input
                            type="text"
                            id="usuario_nombre"
                            name="usuario_nombre"
                            class="input input-bordered w-full"
                            value="{{ old('usuario_nombre', $usuario->usuario_nombre) }}">
                        @if($errors->has('usuario_nombre'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_nombre') }}
                        </p>
                        @endif
                    </fieldset>
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_apellido">Apellido</label>
                        <input
                            type="text"
                            id="usuario_apellido"
                            name="usuario_apellido"
                            class="input input-bordered w-full"
                            value="{{ old('usuario_apellido', $usuario->usuario_apellido) }}">
                        @if($errors->has('usuario_apellido'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_apellido') }}
                        </p>
                        @endif
                    </fieldset>
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_documento">Documento</label>
                        <input
                            type="text"
                            id="usuario_documento"
                            name="usuario_documento"
                            class="input input-bordered w-full"
                            value="{{ old('usuario_documento', $usuario->usuario_documento) }}">
                        @if($errors->has('usuario_documento'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_documento') }}
                        </p>
                        @endif
                    </fieldset>
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_nacimiento">Fecha de Nacimiento</label>
                        <input
                            type="date"
                            id="usuario_nacimiento"
                            name="usuario_nacimiento"
                            class="input input-bordered w-full"
                            value="{{ old('usuario_nacimiento', $usuario->usuario_nacimiento) }}">
                        @if($errors->has('usuario_nacimiento'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_nacimiento') }}
                        </p>
                        @endif
                    </fieldset>
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_telefono">Teléfono</label>
                        <input
                            type="text"
                            id="usuario_telefono"
                            name="usuario_telefono"
                            class="input input-bordered w-full"
                            value="{{ old('usuario_telefono', $usuario->usuario_telefono) }}">
                        @if($errors->has('usuario_telefono'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_telefono') }}
                        </p>
                        @endif
                    </fieldset>
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_direccion">Dirección</label>
                        <input
                            type="text"
                            id="usuario_direccion"
                            name="usuario_direccion"
                            class="input input-bordered w-full"
                            value="{{ old('usuario_direccion', $usuario->usuario_direccion) }}">
                        @if($errors->has('usuario_direccion'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_direccion') }}
                        </p>
                        @endif
                    </fieldset>

                    @if(session('error'))
                    <p class="text-sm font-medium tracking-tight text-red-600">
                        {{ session('error') }}
                    </p>
                    @endif

                    <button type="submit" class="btn btn-primary mt-4">Actualizar</button>
                </form>
            </div>
        </div>

        <!-- Formulario para actualizar contraseña -->

        <div class="collapse collapse-arrow bg-base-200 border border-base-300 rounded-box mt-6">
            <input type="checkbox" />
            <div class="collapse-title text-lg font-medium">
                Actualizar Contraseña
            </div>
            <div class="collapse-content">
                <form
                    data-target="/api/users/{{ $usuario->usuario_id }}"
                    data-method="PUT"
                    data-show-alert="true"
                    data-reload="true"
                    class="upload-form space-y-2">
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="actual_contra">Contraseña Actual</label>
                        <input
                            type="password"
                            id="actual_contra"
                            name="actual_contra"
                            class="input input-bordered w-full">
                        @if($errors->has('actual_contra'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('actual_contra') }}
                        </p>
                        @endif
                    </fieldset>
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_contra">Nueva Contraseña</label>
                        <input
                            type="password"
                            name="usuario_contra"
                            id="usuario_contra"
                            class="input input-bordered w-full">
                        @if($errors->has('usuario_contra'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_contra') }}
                        </p>
                        @endif
                    </fieldset>
                    <fieldset class="w-full fieldset">
                        <label class="fieldset-label after:content-['*'] after:text-red-500" for="usuario_contra_confirmacion">Confirmar Nueva Contraseña</label>
                        <input
                            type="password"
                            id="usuario_contra_confirmacion"
                            name="usuario_contra_confirmacion"
                            class="input input-bordered w-full">
                        @if($errors->has('usuario_contra_confirmacion'))
                        <p class="text-sm font-medium tracking-tight text-red-600">
                            {{ $errors->first('usuario_contra_confirmacion') }}
                        </p>
                        @endif
                    </fieldset>
                    @if(session('password_error'))
                    <p class="text-sm font-medium tracking-tight text-red-600">
                        {{ session('password_error') }}
                    </p>
                    @endif
                    @if(session('password_success'))
                    <p class="text-sm font-medium tracking-tight text-green-600">
                        {{ session('password_success') }}
                    </p>
                    @endif
                    <button type="submit" class="btn btn-primary mt-4">Actualizar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection