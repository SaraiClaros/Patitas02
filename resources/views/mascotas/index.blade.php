@extends('layouts.navigation')

@section('title', 'Lista de Mascotas')

@section('content')
<style>
.container {
    max-width: 900px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
}

h2 {
    margin-bottom: 20px;
    font-style: italic; /* cursiva */
    text-align: center; /* centrado */
    font-weight: bold; /* negrita */
}

.btn-nuevo {
    background-color: #d0c1e1ff; /* morado claro */
    color: #000000; /* letra negra */
    border-radius: 0; /* esquinas puntiagudas */
    font-weight: bold; /* negrita */
    padding: 8px 16px;
    margin-bottom: 20px;
    text-decoration: none;
    display: inline-block;
}

table {
    margin: 0 auto; /* centra la tabla */
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 10px;
    text-align: center;
    vertical-align: middle;
}

table th {
    background-color: #f0f0f0;
}

.btn-editar {
    background-color: #fbcfe8; /* rosado claro */
    color: #000;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: 600;
}

.btn-editar:hover {
    background-color: #f9a8d4;
}

.btn-eliminar {
    background-color: transparent;
    color: #000;
    border: 1px solid #ccc;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: 600;
}

.btn-eliminar:hover {
    background-color: #f0f0f0;
}
</style>

<div class="container">
    <h2>LISTA DE MASCOTAS</h2>

    <a href="{{ route('mascotas.create') }}" class="btn-nuevo">➕ Registrar Mascota</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
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
                    <td class="d-flex gap-1 justify-content-center">
                        <a href="{{ route('mascotas.edit', $mascota->ID_mascota) }}" class="btn-editar">✏️ Editar</a>
                        <form action="{{ route('mascotas.destroy', $mascota->ID_mascota) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta mascota?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
