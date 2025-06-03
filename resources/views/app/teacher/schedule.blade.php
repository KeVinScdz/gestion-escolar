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
                        <div class="w-full space-y-2">
                            <div>
                                <h3 class="text-xl font-semibold">{{ $horario->asignacion->materia->materia_nombre }}</h3>
                                <p class="text-sm font-medium text-base-content/80">{{ $horario->asignacion->grupo->grupo_nombre }}</p>
                            </div>
                            <a href="/dashboard/docente/cursos/{{ $horario->asignacion_id }}">
                                <button class="btn btn-sm py-1 btn-primary">Ver clase</button>
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
<section class="w-full">
    <div class="w-full max-w-[1200px] mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Cursos asignados</h1>

        <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($asignaciones as $asignacion)
            <div class="w-full h-fit bg-neutral-content border border-neutral text-neutral p-4 space-y-5 mb-5">
                <div>
                    <h3 class="text-xl font-semibold">{{ $asignacion->materia->materia_nombre }}</h3>
                    <p class="text-lg font-medium text-base-content/80">{{ $asignacion->grupo->grupo_nombre }}</p>
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
                <a href="/dashboard/docente/cursos/{{ $asignacion->asignacion_id }}">
                    <button class="btn btn-sm py-1 btn-primary">Ver curso</button>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection