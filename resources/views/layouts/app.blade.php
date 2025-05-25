<html data-theme="light">

<head>
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
                <h1 class="text-xl font-medium">Panel de {{ $usuario->rol->rol_nombre }}</h1>
                <label for="my-drawer-2" class="btn btn-primary drawer-button py-1.5 px-2 lg:hidden">
                    <i class="fa-solid fa-bars"></i>
                </label>
            </header>

            <main class="w-full px-5">
                @yield('content')
            </main>
        </div>
        <aside class="drawer-side border-r border-neutral-700">
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
                                {{ $usuario->usuario_nombre[0] }}{{ $usuario->usuario_apellido[0]}}
                            </p>
                        </div>
                    </div>
                    <div class="flex-col text-sm">
                        <p class="font-medium">{{ $usuario->usuario_correo }}</p>
                        <p class="text-xs">{{ $usuario->usuario_nombre }} {{ $usuario->usuario_apellido }}</p>
                        <p class="text-xs text-neutral-content/60">{{ $usuario->rol->rol_nombre }}</p>
                    </div>
                </div>
                <hr class="border-neutral-content/60 my-6">
                <div class="flex-1 overflow-y-auto space-y-2">
                    <li>
                        <a href="/dashboard" class="hover:bg-primary/50 {{ request()->is('/dashboard') ? 'bg-primary' : '' }}">Perfil</a>
                    </li>

                    {{-- Administrador --}}
                    @if($usuario->rol_id == 1)
                    <li>
                        <a href="/dashboard/instituciones" class="hover:bg-primary/50 {{ request()->is('dashboard/instituciones') ? 'bg-primary' : '' }}">Instituciones</a>
                    </li>
                    <li>
                        <a href="/dashboard/usuarios" class="hover:bg-primary/50 {{ request()->is('dashboard/usuarios') ? 'bg-primary' : '' }}">Gestión de Usuarios</a>
                    </li>
                    <li>
                        <details>
                            <summary class="hover:primary/50 {{ request()->is('dashboard/roles') || request()->is('dashboard/permisos') ? bg-primary : '' }}">Roles y Permisos</summary>
                            <ul>
                                <li>
                                    <a href="/dashboard/roles" class="hover:bg-primary/50 {{ request()->is('dashboard/roles') ? 'bg-primary' : '' }}">Gestión de Roles</a>
                                </li>
                                <li>
                                    <a href="/dashboard/permisos" class="hover:bg-primary/50 {{ request()->is('dashboard/permisos') ? 'bg-primary' : '' }}">Gestión de Permisos</a>
                                </li>
                            </ul>
                        </details>
                    </li>
                    @endif

                    {{-- Docente --}}
                    @if($usuario->rol_id == 2)
                    <li>
                        <a href="/dashboard/matriculas" class="hover:bg-primary/50 {{ request()->is('dashboard/matriculas') ? 'bg-primary' : '' }}">Mis Estudiantes</a>
                    </li>
                    <li>
                        <a href="/dashboard/notas" class="hover:bg-primary/50 {{ request()->is('dashboard/notas') ? 'bg-primary' : '' }}">Gestionar Notas</a>
                    </li>
                    <li>
                        <a href="/dashboard/asignaciones" class="hover:bg-primary/50 {{ request()->is('dashboard/asignaciones') ? 'bg-primary' : '' }}">Asignaciones</a>
                    </li>
                    <li>
                        <a href="/dashboard/inasistencias" class="hover:bg-primary/50 {{ request()->is('dashboard/inasistencias') ? 'bg-primary' : '' }}">Inasistencias</a>
                    </li>
                    <li>
                        <a href="/dashboard/observaciones" class="hover:bg-primary/50 {{ request()->is('dashboard/observaciones') ? 'bg-primary' : '' }}">Observaciones</a>
                    </li>
                    @endif

                    {{-- Estudiante --}}
                    @if($usuario->rol_id == 3)
                    <li>
                        <a href="/dashboard/matriculas" class="hover:bg-primary/50 {{ request()->is('dashboard/matriculas') ? 'bg-primary' : '' }}">Mi Matrícula</a>
                    </li>
                    <li>
                        <a href="/dashboard/notas" class="hover:bg-primary/50 {{ request()->is('dashboard/notas') ? 'bg-primary' : '' }}">Mis Notas</a>
                    </li>
                    <li>
                        <a href="/dashboard/inasistencias" class="hover:bg-primary/50 {{ request()->is('dashboard/inasistencias') ? 'bg-primary' : '' }}">Mi Asistencia</a>
                    </li>
                    <li>
                        <a href="/dashboard/pagos" class="hover:bg-primary/50 {{ request()->is('dashboard/pagos') ? 'bg-primary' : '' }}">Mis Pagos</a>
                    </li>
                    @endif

                    {{-- Padre/Madre/Tutor --}}
                    @if($usuario->rol_id == 5)
                    <li>
                        <a href="/dashboard/matriculas" class="hover:bg-primary/50 {{ request()->is('dashboard/matriculas') ? 'bg-primary' : '' }}">Información Académica</a>
                    </li>
                    <li>
                        <a href="/dashboard/observaciones" class="hover:bg-primary/50 {{ request()->is('dashboard/observaciones') ? 'bg-primary' : '' }}">Observaciones</a>
                    </li>
                    <li>
                        <a href="/dashboard/pagos" class="hover:bg-primary/50 {{ request()->is('dashboard/pagos') ? 'bg-primary' : '' }}">Pagos</a>
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