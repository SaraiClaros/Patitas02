@extends('layouts.navigation')

@section('title', 'consultas')

@section('content')
<div class="container">
    <h1>Consultas</h1>
    <a href="{{ route('consultas.create') }}" class="btn btn-primary mb-3">➕ Nueva Consulta</a>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <table class="table table-bordered">
        <thead>
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
            </tr>
            <td>
                <a href="{{ route('consultas.edit', $c->ID_consulta) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                <form action="{{ route('consultas.destroy', $c->ID_consulta) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta consulta?');">
                    @csrf
                    @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
