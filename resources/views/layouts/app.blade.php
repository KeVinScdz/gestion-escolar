<html>

<head>
    <title>@yield('title') | Sistema de Gestión Escolar</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    @section('sidebar')
    This is the master sidebar.
    @show

    <aside class="container">
        @yield('content')
    </aside>
</body>

</html>