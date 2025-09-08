@extends('layouts.navigation')

@section('title', 'Registrar Historial')

@section('content')
<div class="container">
    <h1>Nuevo Registro Médico</h1>
    <form action="{{ route('historial.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Mascota</label>
            <select name="ID_mascota" class="form-control" required>
                @foreach($mascotas as $m)
                    <option value="{{ $m->ID_mascota }}">{{ $m->nombre_m }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha_registro" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Veterinario</label>
            <input type="text" name="veterinario" class="form-control" required>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
