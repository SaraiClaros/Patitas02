@extends('layouts.navigation')

@section('title', 'Publicaciones')

@section('content')

<style>
  .form-wrapper {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 12px;
    background-color: #ffffff;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', sans-serif;
  }

  .form-wrapper h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #555;
  }

  .form-group input[type="text"],
  .form-group textarea,
  .form-group input[type="file"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    transition: border 0.3s;
  }

  .form-group input:focus,
  .form-group textarea:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.1);
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #842029;
    border: 1px solid #f5c2c7;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
  }

  .btn-wrapper {
    display: flex;
    justify-content: space-between;
    gap: 10px;
  }

  .btn-primary, .btn-secondary {
    padding: 10px 20px;
    font-size: 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
  }

  .btn-secondary:hover {
    background-color: #565e64;
  }
</style>

<div class="form-wrapper">
  <h2>Crear nueva publicación</h2>

  @if ($errors->any())
      <div class="alert alert-danger">
          <strong>¡Ups!</strong> Hubo algunos problemas con tus datos:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form action="{{ route('publicaciones.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
          <label for="titulo">Título</label>
          <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
      </div>

      <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea name="descripcion" id="descripcion" rows="4">{{ old('descripcion') }}</textarea>
      </div>

      <div class="form-group">
          <label for="media">Archivo multimedia (imagen o video)</label>
          <input type="file" name="media" id="media" accept="image/*,video/mp4,video/webm">
      </div>

      <div class="btn-wrapper">
          <button type="submit" class="btn-primary">📤 Publicar</button>
          <a href="{{ route('publicaciones.index') }}" class="btn-secondary">❌ Cancelar</a>
      </div>
  </form>
</div>

@endsection