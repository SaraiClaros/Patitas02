@extends('layouts.navigation')

@section('title', 'Vacunaciones')

@section('content')
<div class="container">
    <h1 class="mb-4">Vacunaciones</h1>

    <a href="{{ route('vacunaciones.create') }}" class="btn btn-primary mb-3">➕ Nueva Vacunación</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Mascota</th>
                <th>Vacuna</th>
                <th>Fecha Aplicación</th>
                <th>Próxima Dosis</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacunaciones as $v)
                <tr>
                    <td>{{ $v->mascota->nombre_m }}</td>
                    <td>{{ $v->nombre_vacuna }}</td>
                    <td>{{ $v->fecha_aplicacion }}</td>
                    <td>{{ $v->proxima_dosis }}</td>
                    <td>{{ $v->observaciones }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('vacunaciones.edit', $v->ID_vacunaciones) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                        <form action="{{ route('vacunaciones.destroy', $v->ID_vacunaciones) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta vacunación?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
