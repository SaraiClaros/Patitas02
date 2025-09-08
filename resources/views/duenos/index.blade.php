@extends('layouts.navigation')

@section('title', 'Dueños')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Dueños</h1>

    <a href="{{ route('duenos.create') }}" class="btn btn-primary mb-3">➕ Nuevo Dueño</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>DUI</th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($duenos as $dueno)
                <tr>
                    <td>{{ $dueno->ID_dueno }}</td>
                    <td>{{ $dueno->nombre_d }}</td>
                    <td>{{ $dueno->apellidos }}</td>
                    <td>{{ $dueno->correo }}</td>
                    <td>{{ $dueno->telefono }}</td>
                    <td>{{ $dueno->dui }}</td>
                    <td>
                       
                        <a href="{{ route('duenos.edit', $dueno->ID_dueno) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                        <form action="{{ route('duenos.destroy', $dueno->ID_dueno) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este dueño?');">
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
