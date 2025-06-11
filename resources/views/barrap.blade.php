<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-center">Menú</h4>
        <a href="{{ route('dashboard') }}">🏠 Home</a>
        <a href="{{ route('dashboard') }}">🔔 Notificaciones</a>
        <a href="{{ route('dashboard') }}">💬 Chats</a>
        <a href="{{ route('publicaciones.create') }}">🔍 Buscar</a>
        <a href="{{ route('dashboard') }}">🌍 Explorar</a>
        @auth
        @if (Auth::user()->tipo_usuario === 'refugio')
            <a href="{{ route('dashboard') }}">🐶 Publicar mascota en adopción</a>
        @endif
        @endauth

        <a href="{{ route('dashboard') }}">📁 Expedientes</a>
        <a href="{{ route('profile.edit') }}">👤 Perfil</a> {{-- Nuevo enlace agregado --}}
        {{-- Cierre de sesión --}}
    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px; padding: 0 20px;">
        @csrf
        <button type="submit" style="background: none; border: none; color: white; text-align: left; padding: 10px 0; width: 100%;">
            🚪 Cerrar sesión
        </button>
    </form>
    </div>

    @auth
    <div class="user-menu" style="position: absolute; top: 10px; right: 10px; z-index: 9999;">
        <div style="position: relative;">
            <button id="dropdownToggle" onclick="toggleDropdown()" 
                style="background:none; border:none; cursor:pointer; color:black; font-weight:bold; 
                font-size: 1.2rem; 
                text-align: center; 
                padding-top: 8px;  
                width: 150px; 
                display: block;">
                {{ Auth::user()->name }}
            </button>

            <div id="dropdown" style="display:none; position:absolute; top:100%; right:0; background:white; border:1px solid #ccc; padding:0.5rem; box-shadow:0 4px 8px rgba(0,0,0,0.1); min-width:150px; z-index:9999;">
                <a href="{{ route('profile.edit') }}" style="color:black; text-decoration:none; padding:0.3rem; display: block;">
                    Actualizar Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" style="background:none; border:none; padding:0.3rem; cursor:pointer; color:black; width: 100%; text-align: left;">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endauth

    @isset($header)
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endisset

    <div class="content">
        @yield('content')
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdown');
            const toggle = document.getElementById('dropdownToggle');
            if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    </script>

</body>
</html>

