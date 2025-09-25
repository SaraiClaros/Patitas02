@extends('layouts.navigation')

@section('title', 'Historial')

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
    <h2>HISTORIAL MÉDICO</h2>

    <a href="{{ route('historial.create') }}" class="btn-nuevo">➕ Nuevo Registro</a>

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
                <td>{{ $h->mascota->nombre_m ?? 'Sin mascota' }}</td>
                <td>{{ $h->fecha_registro }}</td>
                <td>{{ $h->descripcion }}</td>
                <td>{{ $h->veterinario }}</td>
                <td class="d-flex gap-1 justify-content-center">
                    <a href="{{ route('historial.edit', $h->ID_Hmedico) }}" class="btn-editar">✏️ Editar</a>

                    <form action="{{ route('historial.destroy', $h->ID_Hmedico) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
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
