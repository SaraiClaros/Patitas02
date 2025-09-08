@extends('layouts.navigation')

@section('title', 'Lista de Mascotas')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Mascotas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('mascotas.create') }}" class="btn btn-primary mb-3">➕ Registrar Mascota</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>N° Registro</th>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Dueño</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mascotas as $mascota)
                <tr>
                    <td>{{ $mascota->ID_mascota }}</td>
                    <td>{{ $mascota->n_registro }}</td>
                    <td>{{ $mascota->nombre_m }}</td>
                    <td>{{ $mascota->especie }}</td>
                    <td>{{ $mascota->raza }}</td>
                    <td>{{ $mascota->sexo }}</td>
                    <td>{{ $mascota->edad }}</td>
                    <td>{{ $mascota->dueno->nombre_d ?? 'Sin dueño' }} {{ $mascota->dueno->apellidos ?? '' }}</td>
                    <td class="d-flex gap-1">
                        <!-- Botón Editar -->
                        <a href="{{ route('mascotas.edit', $mascota->ID_mascota) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('mascotas.destroy', $mascota->ID_mascota) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta mascota?');">
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
