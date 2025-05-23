@extends('layouts.guest')

@section('title', 'Inicio')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto py-10">
        <div class="w-full flex items-center justify-center flex-col text-center space-y-5 min-h-[700px]">
            <div class="badge badge-primary badge-soft badge-lg border-[var(--color-primary)_!important]">
                ¡Nueva versión disponible!
            </div>
            <h1 class="text-7xl font-extrabold">Solución de <span class="text-primary italic">gestión</span> para centros educativos</h1>
            <p class="text-pretty text-lg text-base-content/80">
                <span class="semibold">Matryerse</span> es la plataforma en nube de gestión académica, resultado de profesionales del sector educativo y tecnológico, pioneros en España de la solución 100% nube en 2010, y en constante evolución
            </p>
            <a href="/login" class="btn btn-ghost text-base py-2 group pr-6 mt-8">
                <span class="mr-1">Empezar ahora</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-2 duration-300"></i>
            </a>
        </div>
    </div>
</section>

<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto py-15 pt-0">
        <div class="w-full flex items-center gap-10">
            <div class="md:w-1/2 space-y-6">
                <h2 class="text-4xl font-bold">Todo lo que necesitas en un solo lugar</h2>
                <p class="text-base-content/80 text-lg">
                    Desde la gestión académica, financiera y administrativa hasta la comunicación con familias, Matryerse centraliza todas las operaciones escolares en una única plataforma intuitiva.
                </p>
                <a href="#info" class="btn btn-primary w-max">Solicitar información</a>
            </div>
            <div class="md:w-1/2">
                <figure class="w-full aspect-square max-w-[500px] mx-auto bg-base-300/20 border border-base-300 rounded-lg backdrop-blur-lg overflow-hidden">
                    <img
                        src="https://media.istockphoto.com/id/1216256788/photo/students-learning-via-computer-at-home.jpg?s=612x612&w=0&k=20&c=4vNd7XSmvXqE6LK_GInXRIVR6yab0slw9MWRVEgs6x0="
                        alt="Matryerse" class="w-full h-full object-cover object-right">
                </figure>
            </div>
        </div>
    </div>
</section>

<section class="w-full px-5">
    <div class="max-w-[1200px] mx-auto py-15 space-y-20">
        <h2 class="text-4xl font-bold text-center">¿Por qué elegir Matryerse?</h2>
        <div class="grid md:grid-cols-3 gap-10 text-center">
            <div>
                <i class="fa-solid fa-fingerprint text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold">Identidad educativa sólida</h3>
                <p class="text-base-content/80 mt-2">Cada institución puede personalizar su experiencia y fortalecer su comunidad.</p>
            </div>
            <div>
                <i class="fa-solid fa-check-circle text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold">Calidad académica garantizada</h3>
                <p class="text-base-content/80 mt-2">Seguimiento en tiempo real de desempeño, asistencia y más.</p>
            </div>
            <div>
                <i class="fa-solid fa-leaf text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold">Sostenibilidad a largo plazo</h3>
                <p class="text-base-content/80 mt-2">Solución escalable, modular y siempre disponible en la nube.</p>
            </div>
        </div>
    </div>
</section>

<section class="w-full px-5">
    <div class="max-w-[1200px] mx-auto py-15">
        <h2 class="text-4xl font-bold text-center mb-12">Principales funcionalidades</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-users text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Gestión de usuarios y roles</h3>
                <p class="text-base-content/80">Control total sobre accesos, permisos y perfiles de cada actor del sistema.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-calendar-days text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Matrículas, horarios y notas</h3>
                <p class="text-base-content/80">Automatiza el ciclo académico desde la inscripción hasta la evaluación.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-credit-card text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Módulo financiero</h3>
                <p class="text-base-content/80">Facturación, pagos y control de cartera con trazabilidad completa.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-bullhorn text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Comunicación efectiva</h3>
                <p class="text-base-content/80">Notificaciones, observaciones y reportes para familias y docentes.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-building text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Multi-institución</h3>
                <p class="text-base-content/80">Administra varias sedes o instituciones desde un solo entorno.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-chart-line text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Reportes y analítica</h3>
                <p class="text-base-content/80">Paneles visuales y métricas clave para la toma de decisiones.</p>
            </div>
        </div>
    </div>
</section>
@endsection