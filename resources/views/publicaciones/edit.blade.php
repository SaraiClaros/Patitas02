@extends('layouts.navigation')

@section('title', 'Editar Publicación')

@section('content')
<div class="container" style="max-width:600px; margin:30px auto;">
    <h2>Editar Publicación</h2>
    <form action="{{ route('publicaciones.update', $publicacion) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Título</label>
            <input type="text" name="titulo" value="{{ $publicacion->titulo }}" required class="form-control">
        </div>
        <div>
            <label>Descripción</label>
            <textarea name="descripcion" rows="4" required class="form-control">{{ $publicacion->descripcion }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
    </form>
</div>
@endsection
