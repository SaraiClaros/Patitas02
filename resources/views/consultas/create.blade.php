@extends('layouts.navigation')

@section('title', 'Registrar Consulta')

@section('content')
<div class="container">
    <h1>Nueva Consulta</h1>
    <form action="{{ route('consultas.store') }}" method="POST">
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
            <input type="date" name="fecha_cita" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Motivo</label>
            <input type="text" name="motivo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Diagnóstico</label>
            <textarea name="diagnostico" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="pendiente">Pendiente</option>
                <option value="completada">Completada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
