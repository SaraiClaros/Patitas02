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
                <th>Acciones</th>
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
            <td>
                <a href="{{ route('historial.edit', $h->ID_Hmedico) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                <form action="{{ route('historial.destroy', $h->ID_Hmedico) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                    @csrf
                    @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
