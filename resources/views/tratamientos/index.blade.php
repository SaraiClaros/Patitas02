@extends('layouts.navigation')

@section('title', 'Tratamientos')

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
                <th>Acciones</th>
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
            <td>
                <a href="{{ route('tratamientos.edit', $t->ID_tratamiento) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                <form action="{{ route('tratamientos.destroy', $t->ID_tratamiento) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este tratamiento?');">
                    @csrf
                    @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay tratamientos registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
