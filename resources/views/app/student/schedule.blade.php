@extends('layouts.app')

@section('title', 'Mi horario')

@section('content')
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Mi Horario</h1>
        <div class="w-full overflow-x-auto pb-10">
            <div class="w-full min-w-[1200px] grid grid-cols-5 gap-5">

                @foreach($bloquesHorario as $dia)
                <div class="space-y-5">
                    <div class="w-full space-y-5 bg-neutral-content text-neutral border border-neutral p-2">
                        <h3 class="text-xl font-semibold text-center">{{ ucfirst($dia[0]->bloque_dia) }}</h3>
                    </div>
                    @foreach($dia as $bloque)
                    <div class="w-full bg-neutral-content border border-neutral text-neutral p-4 space-y-5">
                        <h3 class="text-lg font-medium tracking-tight">{{ $bloque->bloque_inicio }} - {{ $bloque->bloque_fin }}</h3>
                        @if($horarios->where('bloque_id', $bloque->bloque_id)->isEmpty())
                        <p>No hay asignaciones para este bloque.</p>
                        @else
                        @foreach($horarios->where('bloque_id', $bloque->bloque_id) as $horario)
                        <div class="w-full space-y-4">
                            <div class="space-y-1">
                                <h3 class="text-xl font-semibold">{{ $horario->asignacion->materia->materia_nombre }}</h3>
                                <p class="leading-tight">
                                    {{ $horario->asignacion->docente->usuario->usuario_nombre }} {{ $horario->asignacion->docente->usuario->usuario_apellido }}
                                </p>
                                <p class="italic text-sm text-base-content/80">
                                    {{ $horario->asignacion->docente->docente_titulo }}
                                </p>
                            </div>
                            <a href="/dashboard/estudiante/materias/{{ $horario->asignacion_id }}">
                                <button class="btn btn-sm py-1 btn-primary">Ver materia</button>
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection