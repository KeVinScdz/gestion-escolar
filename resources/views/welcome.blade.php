@extends('layouts.guest')

@section('title', 'Inicio')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto py-10 min-h-[600px]">
        <div class="w-full h-full flex items-center justify-center flex-col text-center space-y-5">
            <div class="badge badge-primary badge-soft badge-lg border-[var(--color-primary)_!important]">
                ¡Nueva versión disponible!
            </div>
            <h1 class="text-7xl font-extrabold">Solución de <span class="text-primary italic">gestión</span> para centros educativos</h1>
            <p class="text-pretty text-lg text-base-content/80">
                <span class="semibold">Matryerse</span> es la plataforma en nube de gestión académica, resultado de profesionales del sector educativo y tecnológico, pioneros en España de la solución 100% nube en 2010, y en constante evolución
            </p>
            <button class="btn btn-ghost text-base py-2 group pr-6 mt-8">
                <span class="mr-1">Empezar ahora</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-2 duration-300"></i>
            </button>
        </div>
    </div>
</section>
@endsection