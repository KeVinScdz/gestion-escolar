@extends('layouts.app')

@section('title', 'Materias asignadas')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10 space-y-10">
        <h1 class="text-3xl font-bold">Materias Asignadas</h1>

        <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($asignaciones as $asignacion)
            <div class="w-full h-fit bg-neutral-content border border-neutral text-neutral p-4 space-y-3 mb-5">
                <div>
                    <h3 class="text-2xl font-bold">{{ $asignacion->materia->materia_nombre }}</h3>
                    <p class="text-lg font-medium text-base-content">
                        {{ $asignacion->docente->usuario->usuario_nombre }} {{ $asignacion->docente->usuario->usuario_apellido }}
                    </p>
                    <p class="text-sm text-base-content/80">
                        {{ $asignacion->docente->docente_titulo }}
                    </p>
                </div>
                <div class="collapse collapse-arrow">
                    <input type="checkbox" />
                    <div class="collapse-title font-semibold">Dias de clase Correspondientes</div>
                    <div class="collapse-content text-sm">
                        <ul class="border-l border-base-content/20 pl-4">
                            @foreach ($asignacion->horarios as $horario)
                            <li class="text-sm text-base-content/80">{{ $horario->bloque->bloque_dia }} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a href="/dashboard/estudiante/materias/{{ $asignacion->asignacion_id }}">
                    <button class="btn btn-sm py-1 btn-primary">Ver curso</button>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection