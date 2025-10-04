@extends('layouts.navigation')

@section('title', 'Mensajes')

@section('content')
<div class="container mt-4" style="max-width:600px;">
    


    <!-- Barra de búsqueda con lupa -->
    <form method="GET" action="{{ route('mensajes.usuarios') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar usuario..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    <!-- Usuarios que sigo -->
    <h2 class="text-center mb-4 fw-bold fst-italic" style="font-family: 'Cursive', 'Georgia', serif; letter-spacing: 1px;"> Usuarios que sigo </h2>

    <div class="row">
        @forelse($followingUsers as $user)
            <div class="col-12 mb-3">
                <div class="card d-flex flex-row align-items-center p-2 shadow-sm">
                    @if($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" 
                             alt="Foto de perfil" 
                             class="rounded-circle me-3" 
                             width="50" height="50">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3" 
                             style="width:50px; height:50px; font-weight:bold; font-size:20px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-grow-1">
                        <a href="{{ route('perfil.show', $user->id) }}" class="text-decoration-none text-dark">
                            <h5 class="mb-0">{{ $user->name }}</h5>
                        </a>
                    </div>
                    <a href="{{ route('chat', $user->id) }}" class="btn btn-purple btn-sm">Chatear</a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card p-3 text-center text-muted">
                    No seguís a ningún usuario aún.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Resultados de búsqueda -->
    @if(!empty($search))
        <h4 class="text-center mt-4 mb-3">Resultados de la búsqueda</h4>
        <div class="row">
            @forelse($allUsers as $user)
                <div class="col-12 mb-3">
                    <div class="card d-flex flex-row align-items-center p-2 shadow-sm">
                        @if($user->profile_photo_url)
                            <img src="{{ $user->profile_photo_url }}" 
                                 alt="Foto de perfil" 
                                 class="rounded-circle me-3" 
                                 width="50" height="50">
                        @else
                            <div class="rounded-circle bg-secondary text-black d-flex justify-content-center align-items-center me-3" 
                                 style="width:50px; height:50px; font-weight:bold; font-size:20px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex-grow-1">
                            <a href="{{ route('perfil.show', $user->id) }}" class="text-decoration-none text-dark">
                                <h5 class="mb-0">{{ $user->name }}</h5>
                            </a>
                        </div>
                        <a href="{{ route('chat', $user->id) }}" class="btn btn-secondary btn-sm">Chatear</a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card p-3 text-center text-muted">
                        No se encontraron usuarios.
                    </div>
                </div>
            @endforelse
        </div>
    @endif
</div>

<!-- Estilos para botón morado -->
<style>
.btn-purple {
    background-color: #d6caedff;
    color: #000;
}
.btn-purple:hover {
    background-color: #836cb4ff;
    color: #000;
}
</style>
@endsection
