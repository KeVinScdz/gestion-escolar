<html data-theme="dark">

<head>
    <title>@yield('title') | Sistema de Gestión Escolar</title>
    <script src="https://kit.fontawesome.com/eb36e646d1.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css'])
</head>

<body class="flex flex-col min-h-screen w-full font-poppins">
    <header class="w-full px-5 z-50 sticky top-0">
        <div class="w-full max-w-[1200px] mx-auto py-5 flex justify-between">
            <div class="flex-1 text-2xl font-oswald">
                <a href="/" class="hover:text-primary duration-300 cursor-pointer">MATRYERSE</a>
            </div>
            <nav>
                <ul class="flex gap-5">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Iniciar Sesión</a></li>
                    <li><a href="#">Registrarse</a></li>
                </ul>
            </nav>
            <div class="flex-1 flex justify-end">
                <button class="btn btn-primary btn-outline">
                    <i class="fa-solid fa-right-to-bracket text-sm"></i>
                    <span class="ml-1">Autenticate</span>
                </button>
            </div>
        </div>
    </header>
    <main class="w-full flex-1 flex flex-col">
        @yield('content')
    </main>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 h-30 w-300 blur-[500px] rounded-[50%] bg-primary/50"></div>
    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 h-30 w-500 blur-[500px] rounded-[50%] bg-white/10"></div>
</body>

</html>