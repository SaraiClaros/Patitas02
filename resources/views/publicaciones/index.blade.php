
<div class="container mt-4">
    <h1 class="text-center mb-4">Mis Publicaciones</h1>

    <div class="text-center mb-4">
        <a href="{{ route('publicaciones.create') }}" class="btn btn-primary">Crear nueva publicación</a>
    </div>

    <div class="row justify-content-center">
        @foreach ($publicaciones as $publicacion)
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    @if ($publicacion->imagen)
                        <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="card-img-top" alt="Imagen de {{ $publicacion->titulo }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $publicacion->titulo }}</h5>
                        <p class="card-text">{{ $publicacion->descripcion }}</p>
                        <p class="text-muted small mb-0">Publicado por: {{ $publicacion->user->name ?? 'Usuario desconocido' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

