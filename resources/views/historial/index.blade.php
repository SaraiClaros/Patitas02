@extends('layouts.navigation')

@section('title', 'Historial')

@section('content')
<div class="container">
    <h1>Historial Médico</h1>
    <a href="{{ route('historial.create') }}" class="btn btn-primary mb-3">➕ Nuevo Registro</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Veterinario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historiales as $h)
            <tr>
                <td>{{ $h->mascota->nombre_m }}</td>
                <td>{{ $h->fecha_registro }}</td>
                <td>{{ $h->descripcion }}</td>
                <td>{{ $h->veterinario }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
