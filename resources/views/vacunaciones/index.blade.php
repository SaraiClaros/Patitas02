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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
