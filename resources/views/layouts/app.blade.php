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
            <header class="w-full bg-neutral text-neutral-content p-4 border-b border-neutral-700 flex justify-between items-center">
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
                                {{ $usuario->persona->persona_nombre[0] }}
                            </p>
                        </div>
                    </div>
                    <div class="flex-col text-sm">
                        <p class="font-medium">{{ $usuario->usuario_correo }}</p>
                        <p class="text-xs">{{ $usuario->persona->persona_nombre }} {{ $usuario->persona->persona_apellido }}</p>
                        <p class="text-xs text-neutral-content/60">{{ $usuario->rol->rol_nombre }}</p>
                    </div>
                </div>
                <hr class="border-neutral-content/60 my-6">
                <div class="flex-1 overflow-y-auto space-y-2">
                    <li>
                        <a href="/dashboard" class="hover:bg-primary/50 {{ request()->is('dashboard') ? 'bg-primary' : '' }}">Perfil</a>
                    </li>
                    @if($usuario->rol_id == 1)
                        <li>
                            <a href="/dashboard/usuarios" class="hover:bg-primary/50 {{ request()->is('dashboard/usuarios') ? 'bg-primary' : '' }}">Usuarios</a>
                        </li>
                        <li>
                            <a href="/dashboard/roles" class="hover:bg-primary/50 {{ request()->is('dashboard/roles') ? 'bg-primary' : '' }}">Roles</a>
                        </li>
                        <li>
                            <a href="/dashboard/permisos" class="hover:bg-primary/50 {{ request()->is('dashboard/permisos') ? 'bg-primary' : '' }}">Permisos</a>
                        </li>
                    @endif
                    @if($usuario->rol_id == 2)
                        <li>
                            <a href="/dashboard/academico" class="hover:bg-primary/50 {{ request()->is('dashboard/academico') ? 'bg-primary' : '' }}">Académico</a>
                        </li>
                    @endif
                    @if($usuario->rol_id == 3)
                        <li>
                            <a href="/dashboard/administrativo" class="hover:bg-primary/50 {{ request()->is('dashboard/administrativo') ? 'bg-primary' : '' }}">Administrativo</a>
                        </li>
                    @endif
                    @if($usuario->rol_id == 4)
                        <li>
                            <a href="/dashboard/financiero" class="hover:bg-primary/50 {{ request()->is('dashboard/financiero') ? 'bg-primary' : '' }}">Financiero</a>
                        </li>
                    @endif
                    @if($usuario->rol_id == 5)
                        <li>
                            <a href="/dashboard/secretaria" class="hover:bg-primary/50 {{ request()->is('dashboard/secretaria') ? 'bg-primary' : '' }}">Secretaría</a>
                        </li>
                    @endif
                    @if($usuario->rol_id == 6)
                        <li>
                            <a href="/dashboard/docente" class="hover:bg-primary/50 {{ request()->is('dashboard/docente') ? 'bg-primary' : '' }}">Docente</a>
                        </li>
                    @endif
                    @if($usuario->rol_id == 7)
                        <li>
                            <a href="/dashboard/estudiante" class="hover:bg-primary/50 {{ request()->is('dashboard/estudiante') ? 'bg-primary' : '' }}">Estudiante</a>
                        </li>
                    @endif
                </div>
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