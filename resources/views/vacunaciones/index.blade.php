@extends('layouts.navigation')

@section('title', 'Vacunaciones')

@section('content')
<div class="container">
    <h1>Vacunaciones</h1>
    <a href="{{ route('vacunaciones.create') }}" class="btn btn-primary mb-3">➕ Nueva Vacunación</a>

    <table class="table table-bordered">
        <thead>
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
            </tr>
            <a href="{{ route('vacunaciones.edit', $v->ID_vacunacion) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                <form action="{{ route('vacunaciones.destroy', $v->ID_vacunacion) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta vacunación?');">
                    @csrf
                    @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
