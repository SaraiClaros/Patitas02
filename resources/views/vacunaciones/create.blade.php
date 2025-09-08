@extends('layouts.navigation')

@section('title', 'Registrar Vacunación')

@section('content')
<div class="container">
    <h1>Nueva Vacunación</h1>
    <form action="{{ route('vacunaciones.store') }}" method="POST">
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
            <label>Nombre Vacuna</label>
            <input type="text" name="nombre_vacuna" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha Aplicación</label>
            <input type="date" name="fecha_aplicacion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Próxima Dosis</label>
            <input type="date" name="proxima_dosis" class="form-control">
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
