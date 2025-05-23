<html data-theme="dark">

<head>
    <title>@yield('title') | Sistema de Gestión Escolar</title>
    <script src="https://kit.fontawesome.com/eb36e646d1.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css'])
</head>

<body class="flex flex-col min-h-screen w-full font-poppins">
    <header id="main-header" class="w-full px-5 z-50 sticky top-0 transition-all duration-300 border-transparent">
        <div class="w-full max-w-[1200px] mx-auto py-5 flex items-center justify-between">
            <div class="flex-1 text-2xl font-oswald">
                <a href="/" class="hover:text-primary duration-300 cursor-pointer">MATRYERSE</a>
            </div>
            <nav>
                <ul class="flex gap-5">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/login">Iniciar Sesión</a></li>
                    <li><a href="/register">Registrarse</a></li>
                </ul>
            </nav>
            <div class="flex-1 flex justify-end">
                <a href="/login" class="btn btn-primary btn-outline py-1">
                    <i class="fa-solid fa-right-to-bracket text-sm"></i>
                    <span class="ml-1">Autenticate</span>
                </a>
            </div>
        </div>
    </header>

    <main class="w-full flex-1 space-y-20 mb-15">
        @yield('content')
    </main>

    <footer class="w-full py-4 bg-base-200 text-center text-sm text-base-content">
        &copy; {{ date('Y') }} MATRYERSE. All rights reserved.
    </footer>

    <div class="fixed top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 h-30 w-300 blur-[500px] rounded-[50%] bg-primary/50"></div>
    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 h-30 w-500 blur-[500px] rounded-[50%] bg-white/10"></div>

    <style>
        .glass-effect {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    <script>
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 10) {
                header.classList.add('glass-effect', 'bg-base-200/50');
            } else {
                header.classList.remove('glass-effect', 'bg-base-200/50');
            }
        });
    </script>
</body>

</html>