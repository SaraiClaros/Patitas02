@extends('layouts.navigation')

@section('title', 'Dueños')

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
    font-weight: bold;
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
    <h2 class="mb-4">LISTA DE DUEÑOS</h2>

    <a href="{{ route('duenos.create') }}" class="btn-nuevo">➕ Nuevo Dueño</a>

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
                        <a href="{{ route('duenos.edit', $dueno->ID_dueno) }}" class="btn-editar">✏️ Editar</a>

                        <form action="{{ route('duenos.destroy', $dueno->ID_dueno) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este dueño?');">
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
