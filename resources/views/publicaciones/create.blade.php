@extends('layouts.navigation')

@section('title', 'Crear Publicación')

@section('content')

<style>
  /* 👇 Ya no tocamos el body, solo la clase .form-page 
  .form-page {
    font-family: 'Poppins', sans-serif;
    background-color: #f0f2f5;
    min-height: 100vh;
    padding-top: 40px;
    padding-bottom: 40px;
  } */

  .form-wrapper {
    max-width: 520px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 20px;
    padding: 30px 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .form-wrapper:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
  }

  .form-wrapper h2 {
    text-align: center;
    font-weight: 700;
    margin-bottom: 25px;
    color: #2c3e50;
    font-size: 28px;
  }

  .form-group {
    margin-bottom: 22px;
  }

  .form-group label {
    font-weight: 600;
    display: block;
    margin-bottom: 8px;
    color: #34495e;
    font-size: 15px;
  }

  .form-group input[type="text"],
  .form-group textarea,
  .form-group input[type="file"] {
    width: 100%;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1px solid #dfe6e9;
    font-size: 15px;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
  }

  .form-group input:focus,
  .form-group textarea:focus {
    outline: none;
    border-color: #3e6358ff;
    box-shadow: 0 0 0 3px rgba(62, 99, 88, 0.2);
    background-color: #ffffff;
  }

  .btn-wrapper {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
  }

  .btn-primary, .btn-secondary {
    flex: 1 1 48%;
    text-align: center;
    border: none;
    border-radius: 14px;
    padding: 12px 0;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
  }

  .btn-primary {
    background: linear-gradient(135deg, #3e6358ff, #5f8d7a);
    color: #fff;
    box-shadow: 0 4px 12px rgba(62, 99, 88, 0.3);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(62, 99, 88, 0.35);
  }

  .btn-secondary {
    background-color: #ecf0f1;
    color: #2c3e50;
    text-decoration: none;
    display: inline-block;
    text-align: center;
  }

  .btn-secondary:hover {
    background-color: #dcdde1;
  }

  .alert-danger {
    background-color: #fce4e4;
    color: #c0392b;
    border-radius: 12px;
    padding: 14px 16px;
    margin-bottom: 20px;
    font-size: 14px;
  }
</style>

<div class="form-page">
  <div class="form-wrapper">
    <h2>📸 Nueva publicación</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
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
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" placeholder="Escribe un título llamativo" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" placeholder="Escribe algo sobre tu publicación...">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="media">Foto o Video</label>
            <input type="file" name="media" id="media" accept="image/*,video/mp4,video/webm">
        </div>

        <div class="btn-wrapper">
            <button type="submit" class="btn-primary">📤 Publicar</button>
            <a href="{{ route('publicaciones.index') }}" class="btn-secondary">❌ Cancelar</a>
        </div>
    </form>
  </div>
</div>

@endsection