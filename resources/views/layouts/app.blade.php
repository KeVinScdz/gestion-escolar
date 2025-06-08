<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Sistema de Gestión Escolar</title>
    <script src="https://kit.fontawesome.com/eb36e646d1.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/uploadForm.js'])
</head>

<body class="font-poppins">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content w-full h-screen overflow-y-auto">
            <!-- Page content here -->
            <header class="w-full bg-neutral text-neutral-content p-4 border-b border-neutral-700 flex justify-between items-center sticky top-0 z-50">
                <h1 class="text-xl font-medium">Panel de {{ $usuarioSesion->rol->rol_nombre }}</h1>
                <label for="my-drawer-2" class="btn btn-primary drawer-button py-1.5 px-2 lg:hidden">
                    <i class="fa-solid fa-bars"></i>
                </label>
            </header>

            <main class="w-full px-5">
                @yield('content')
            </main>
        </div>
        <aside class="drawer-side border-r border-neutral-700 z-[51]">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-neutral text-neutral-content min-h-full w-80 p-4">
                <a href="/dashboard" class="w-full space-y-2">
                    <figure class="w-full flex justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-20 aspect-square object-contain">
                    </figure>
                    <h1 class="text-2xl font-oswald text-center uppercase hover:text-base-300 duration-300">Matryerse</h1>
                </a>
                <hr class="border-neutral-content/60 my-6">
                <div class="w-full hover:bg-white/10 p-4 rounded duration-200 flex items-center gap-4">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-primary text-primary-content w-12 rounded-full">
                            <p class="text-xl">
                                {{ $usuarioSesion->usuario_nombre[0] }}{{ $usuarioSesion->usuario_apellido[0]}}
                            </p>
                        </div>
                    </div>
                    <div class="flex-col text-sm">
                        <p class="font-medium">{{ $usuarioSesion->usuario_correo }}</p>
                        <p class="text-xs">{{ $usuarioSesion->usuario_nombre }} {{ $usuarioSesion->usuario_apellido }}</p>
                        <p class="text-xs text-neutral-content/60">
                            @if($usuarioSesion->rol_id == 2 && $usuarioSesion->administrativo)
                            {{ $usuarioSesion->administrativo->administrativo_cargo }}
                            @elseif($usuarioSesion->rol_id == 3 && $usuarioSesion->docente)
                            {{ $usuarioSesion->docente->docente_titulo }}
                            @elseif($usuarioSesion->rol_id == 4 && $usuarioSesion->estudiante)
                            Estudiante de {{ $usuarioSesion->estudiante->matriculas->last()->grupo->grupo_nombre }}
                            @elseif($usuarioSesion->rol_id == 5 && $usuarioSesion->tutor)
                            Tutor de {{ $usuarioSesion->tutor->estudiante->usuario->usuario_nombre }} {{ $usuarioSesion->tutor->estudiante->usuario->usuario_apellido }}
                            @else
                            {{ $usuarioSesion->rol->rol_nombre }}
                            @endif
                        </p>
                    </div>
                </div>
                <hr class="border-neutral-content/60 my-6">
                <div class="flex-1 overflow-y-auto space-y-2">
                    <li>
                        <a href="/dashboard" class="hover:bg-primary/50 {{ request()->is('/dashboard') ? 'bg-primary' : '' }}">Perfil</a>
                    </li>

                    {{-- Administrador --}}
                    @if($usuarioSesion->rol_id == 1)
                    <li>
                        <a href="/dashboard/estadisticas" class="hover:bg-primary/50 {{ request()->is('dashboard/estadisticas') ? 'bg-primary' : '' }}">Estadísticas</a>
                    </li>
                    <li>
                        <a href="/dashboard/instituciones" class="hover:bg-primary/50 {{ request()->is('dashboard/instituciones') ? 'bg-primary' : '' }}">Instituciones</a>
                    </li>
                    <li>
                        <a href="/dashboard/usuarios" class="hover:bg-primary/50 {{ request()->is('dashboard/usuarios') ? 'bg-primary' : '' }}">Gestión de Usuarios</a>
                    </li>
                    @endif

                    {{-- Administrativo --}}
                    @if($usuarioSesion->rol_id == 2)
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 1))
                    <li>
                        <a href="/dashboard/institucion" class="hover:bg-primary/50 {{ request()->is('dashboard/instituciones')? 'bg-primary' : '' }}">Gestionar Institución</a>
                    </li>
                    <li>
                        <a href="/dashboard/institucion/estadisticas" class="hover:bg-primary/50 {{ request()->is('dashboard/institucion/estadisticas') ? 'bg-primary' : '' }}">Estadísticas de la Institución</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 2))
                    <li>
                        <a href="/dashboard/administrativos" class="hover:bg-primary/50 {{ request()->is('dashboard/administrativos')? 'bg-primary' : '' }}">Gestión de Administrativos</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 3))
                    <li>
                        <a href="/dashboard/docentes" class="hover:bg-primary/50 {{ request()->is('dashboard/docentes')? 'bg-primary' : '' }}">Gestión de Docentes</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 4))
                    <li>
                        <a href="/dashboard/estudiantes" class="hover:bg-primary/50 {{ request()->is('dashboard/estudiantes') ? 'bg-primary' : '' }}">Gestión de Estudiantes</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 4))
                    <li>
                        <a href="/dashboard/solicitudes" class="hover:bg-primary/50 {{ request()->is('dashboard/solicitudes') ? 'bg-primary' : '' }}">Solicitudes de Matrícula</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 8))
                    <li>
                        <a href="/dashboard/periodos" class="hover:bg-primary/50 {{ request()->is('dashboard/periodos')? 'bg-primary' : '' }}">Gestión de Periodos</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 5))
                    <li>
                        <a href="/dashboard/cursos" class="hover:bg-primary/50 {{ request()->is('dashboard/cursos') ? 'bg-primary' : '' }}">Gestión de Cursos</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 6))
                    <li>
                        <a href="/dashboard/materias" class="hover:bg-primary/50 {{ request()->is('dashboard/materias')? 'bg-primary' : '' }}">Gestión de Materias</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 7))
                    <li>
                        <a href="/dashboard/horarios" class="hover:bg-primary/50 {{ request()->is('dashboard/horarios')? 'bg-primary' : '' }}">Gestión de Horarios</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 9))
                    <li>
                        <a href="/dashboard/inasistencias" class="hover:bg-primary/50 {{ request()->is('dashboard/inasistencias')? 'bg-primary' : '' }}">Gestión de Inasistencias</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 10))
                    <li>
                        <a href="/dashboard/observaciones" class="hover:bg-primary/50 {{ request()->is('dashboard/observaciones')? 'bg-primary' : '' }}">Gestión de Observaciones</a>
                    </li>
                    @endif
                    @if ($usuarioSesion->administrativo->permisos->contains('permiso_id', 11))
                    <li>
                        <a href="/dashboard/pagos" class="hover:bg-primary/50 {{ request()->is('dashboard/pagos')? 'bg-primary' : '' }}">Gestión de Pagos</a>
                    </li>
                    @endif
                    @endif

                    {{-- Docente --}}
                    @if($usuarioSesion->rol_id == 3)
                    <li>
                        <a href="/dashboard/docente/horario" class="hover:bg-primary/50 {{ request()->is('dashboard/docente/horario') ? 'bg-primary' : '' }}">
                            Mi Horario
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/docente/cursos" class="hover:bg-primary/50 {{ request()->is('dashboard/docente/cursos') ? 'bg-primary' : '' }}">
                            Mis Cursos
                        </a>
                    </li>
                    @endif



                    {{-- Estudiante --}}
                    @if($usuarioSesion->rol_id == 4)
                    <li>
                        <a href="/dashboard/estudiante/horario" class="hover:bg-primary/50 {{ request()->is('dashboard/estudiante/horario') ? 'bg-primary' : '' }}">
                            Mi Horario
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/estudiante/materias" class="hover:bg-primary/50 {{ request()->is('dashboard/estudiante/materias') ? 'bg-primary' : '' }}">
                            Mis Materias
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/estudiante/inasistencias" class="hover:bg-primary/50 {{ request()->is('dashboard/estudiante/inasistencias') ? 'bg-primary' : '' }}">
                            Mis Inasistencias
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/estudiante/observaciones" class="hover:bg-primary/50 {{ request()->is('dashboard/estudiante/observaciones') ? 'bg-primary' : '' }}">
                            Mis Observaciones
                        </a>
                    </li>
                    @endif

                    {{-- Padre/Madre/Tutor --}}
                    @if($usuarioSesion->rol_id == 5)
                    <li>
                        <a href="/dashboard/tutor/estudiante" class="hover:bg-primary/50 {{ request()->is('dashboard/tutor/estudiante') ? 'bg-primary' : '' }}">
                            Información del Estudiante
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/tutor/notas" class="hover:bg-primary/50 {{ request()->is('dashboard/tutor/notas') ? 'bg-primary' : '' }}">
                            Notas Académicas
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/tutor/horario" class="hover:bg-primary/50 {{ request()->is('dashboard/tutor/horario') ? 'bg-primary' : '' }}">
                            Horario Semanal
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/tutor/inasistencias" class="hover:bg-primary/50 {{ request()->is('dashboard/tutor/inasistencias') ? 'bg-primary' : '' }}">
                            Registro de Inasistencias
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/tutor/observaciones" class="hover:bg-primary/50 {{ request()->is('dashboard/tutor/observaciones') ? 'bg-primary' : '' }}">
                            Observaciones
                        </a>
                    </li>
                    @endif

                </div>
                <hr class="border-neutral-content/60 my-6">
                <div>
                    <li>
                        <a class="block">
                            <form id="logout-form" action="/logout" method="POST">
                                @csrf
                                <button type="button" class="btn btn-error w-full" onclick="confirmLogout()">Cerrar sesión</button>
                            </form>
                        </a>
                    </li>
                </div>
            </ul>
        </aside>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: '¿Estás seguro de que deseas cerrar sesión?',
                icon: 'warning',
                showCancelButton: true,
                background: 'var(--color-neutral)',
                color: 'var(--color-neutral-content)',
                confirmButtonColor: '#d33',
                cancelButtonColor: 'var(--color-primary)',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    @yield('scripts')
</body>

</html>