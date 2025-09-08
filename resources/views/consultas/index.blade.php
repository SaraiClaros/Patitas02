@extends('layouts.navigation')

@section('title', 'Consultas')

@section('content')
<div class="container">
    <h1 class="mb-4">Consultas</h1>

    <a href="{{ route('consultas.create') }}" class="btn btn-primary mb-3">➕ Nueva Consulta</a>

    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Mascota</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Diagnóstico</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultas as $c)
                <tr>
                    <td>{{ $c->mascota->nombre_m }}</td>
                    <td>{{ $c->fecha_cita }}</td>
                    <td>{{ $c->motivo }}</td>
                    <td>{{ $c->diagnostico }}</td>
                    <td>{{ $c->estado }}</td>
                    <td class="d-flex gap-1">
                        <!-- Botón Editar -->
                        <a href="{{ route('consultas.edit', $c->ID_consultas) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('consultas.destroy', $c->ID_consultas) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta consulta?')">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
