@extends('layouts.navigation')

@section('title', 'Perfil de ' . $user->name)

@section('content')
<div class="container-feed">
    <div style="margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
        <h2>{{ $user->name }}</h2>

        @auth
            @if(auth()->id() !== $user->id)
                <button class="btn-seguir" data-url="{{ route('usuarios.toggleFollow', $user->id) }}">
                    {{ $siguiendo ? 'Siguiendo' : 'Seguir' }} ({{ $user->seguidores()->count() }})
                </button>
            @endif
        @endauth
    </div>

    {{-- Lista de publicaciones y compartidos --}}
    @foreach($feed as $publicacion)
        <div class="card">
            <div class="card-header">
                <img src="{{ $publicacion->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($publicacion->user->name) }}" alt="avatar" class="avatar">
                <div>
                    <div class="username">{{ $publicacion->user->name }}</div>
                    <div class="timestamp">{{ $publicacion->created_at->diffForHumans() }}</div>
                </div>
            </div>

            <div class="card-body">
                @if(!empty($publicacion->es_compartida))
                    <small>Compartido por {{ $publicacion->compartida_por->name }}</small><br>
                @endif

                <div class="descripcion">
                    <strong>{{ $publicacion->titulo }}</strong><br>
                    {{ $publicacion->descripcion }}
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
