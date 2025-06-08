@extends('layouts.guest')

@section('title', 'Inicio')

@section('content')

{{-- HERO SECTION --}}
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto py-10">
        <div class="w-full flex items-center justify-center flex-col text-center space-y-5 min-h-[700px]">
            <div class="badge badge-primary badge-soft badge-lg border-[var(--color-primary)_!important]">
                ¡Nueva versión disponible!
            </div>
            <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold">La <span class="text-primary italic">plataforma integral</span> para tu institución educativa</h1>
            <p class="text-pretty text-lg text-base-content/80 max-w-[800px]">
                <span class="font-semibold">Matryerse</span> digitaliza y simplifica la gestión académica, administrativa y financiera en una sola plataforma web, segura, moderna y siempre disponible en la nube.
            </p>
            <a href="/login" class="btn btn-ghost text-base py-2 group pr-6 mt-8">
                <span class="mr-1">Explorar plataforma</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-2 duration-300"></i>
            </a>
        </div>
    </div>
</section>

{{-- DESCRIPCIÓN BREVE --}}
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto py-15 pt-0">
        <div class="w-full flex flex-col-reverse md:flex-row items-center gap-10">
            <div class="md:w-1/2 space-y-6">
                <h2 class="text-4xl font-bold">Todo en un solo lugar</h2>
                <p class="text-base-content/80 text-lg">
                    Desde la matrícula de estudiantes, horarios de docentes, boletines automáticos, hasta comunicaciones con padres y reportes financieros: centraliza la operación de tu institución con Matryerse.
                </p>
                <a href="/info" class="btn btn-primary w-max">Solicitar información</a>
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

{{-- POR QUÉ ELEGIRNOS --}}
<section class="w-full px-5">
    <div class="max-w-[1200px] mx-auto py-15 space-y-20">
        <h2 class="text-4xl font-bold text-center">¿Por qué elegir Matryerse?</h2>
        <div class="grid md:grid-cols-3 gap-10 text-center">
            <div>
                <i class="fa-solid fa-lock text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold">Seguridad y respaldo</h3>
                <p class="text-base-content/80 mt-2">Tus datos protegidos con infraestructura en la nube de última generación.</p>
            </div>
            <div>
                <i class="fa-solid fa-handshake text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold">Soporte dedicado</h3>
                <p class="text-base-content/80 mt-2">Asistencia personalizada durante y después de la implementación.</p>
            </div>
            <div>
                <i class="fa-solid fa-rocket text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold">Innovación constante</h3>
                <p class="text-base-content/80 mt-2">Mejoras continuas, integraciones y nuevas funciones todo el año.</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA FINAL --}}
<section class="w-full px-5 bg-primary/5 py-20">
    <div class="max-w-[900px] mx-auto text-center space-y-6">
        <h2 class="text-3xl font-bold">¿Listo para transformar tu institución?</h2>
        <p class="text-base-content/80 text-lg">Contáctanos y agenda una demostración gratuita. Te mostraremos cómo Matryerse puede ayudarte a mejorar la gestión educativa.</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="/info" class="btn btn-primary">Solicitar información</a>
            <a href="/login" class="btn btn-outline">Ingresar al sistema</a>
        </div>
    </div>
</section>

{{-- FUNCIONALIDADES PRINCIPALES --}}
<section class="w-full px-5">
    <div class="max-w-[1200px] mx-auto py-15">
        <h2 class="text-4xl font-bold text-center mb-12">Principales funcionalidades</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-users text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Gestión de usuarios y roles</h3>
                <p class="text-base-content/80">Control total sobre accesos, permisos y perfiles para cada miembro de la comunidad educativa.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-calendar-days text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Matrículas, horarios y notas</h3>
                <p class="text-base-content/80">Automatización de ciclos académicos, creación de horarios sin choques, boletines automáticos.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-credit-card text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Módulo financiero</h3>
                <p class="text-base-content/80">Facturación, control de pagos y reportes financieros adaptados a cada institución.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-bullhorn text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Comunicación con tutores</h3>
                <p class="text-base-content/80">Observaciones, reportes de asistencia, notas y mensajes centralizados.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-building text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Multi-institución</h3>
                <p class="text-base-content/80">Administra múltiples sedes o instituciones desde una sola cuenta.</p>
            </div>
            <div class="p-6 bg-base-200 rounded-lg">
                <i class="fa-solid fa-chart-line text-3xl text-primary mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Estadísticas</h3>
                <p class="text-base-content/80">Métricas clave: asistencia, rendimiento académico y más.</p>
            </div>
        </div>
    </div>
</section>

@endsection
