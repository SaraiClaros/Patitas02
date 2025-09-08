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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
