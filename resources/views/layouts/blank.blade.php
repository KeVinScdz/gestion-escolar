<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Sistema de Gestión Escolar</title>
    <script src="https://kit.fontawesome.com/eb36e646d1.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/uploadForm.js'])
</head>

<body class="flex flex-col min-h-screen w-full font-poppins">

    <main class="w-full flex-1 flex flex-col">
        @yield('content')
    </main>

    <div class="fixed top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 h-30 w-300 blur-[500px] rounded-[50%] bg-primary/50"></div>
    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 h-30 w-500 blur-[500px] rounded-[50%] bg-white/10"></div>
</body>

</html>