@extends('layouts.navigation')

@section('title', 'Registrar Tratamiento')

@section('content')
<div class="container">
    <h1>Tratamientos</h1>
    <a href="{{ route('tratamientos.create') }}" class="btn btn-primary mb-3">➕ Nuevo Tratamiento</a>

    <table class="table table-bordered">
        <thead>
            <tr>    
                <th>Mascota</th>
                <th>Tratamiento</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tratamientos as $t)
            <tr>
                <td>{{ $t->mascota->nombre_m }}</td>
                <td>{{ $t->tratamiento }}</td>
                <td>{{ $t->fecha_inicio }}</td>
                <td>{{ $t->fecha_fin ?? '—' }}</td>
                <td>{{ $t->observaciones }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay tratamientos registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
