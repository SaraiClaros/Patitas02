@extends('layouts.navigation')

@section('title', 'Vacunaciones')

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
    <h2>VACUNACIONES</h2>

    <a href="{{ route('vacunaciones.create') }}" class="btn-nuevo">➕ Nueva Vacunación</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
                    <td>{{ $v->mascota->nombre_m ?? 'Sin mascota' }}</td>
                    <td>{{ $v->nombre_vacuna }}</td>
                    <td>{{ $v->fecha_aplicacion }}</td>
                    <td>{{ $v->proxima_dosis }}</td>
                    <td>{{ $v->observaciones }}</td>
                    <td class="d-flex gap-1 justify-content-center">
                        <a href="{{ route('vacunaciones.edit', $v->ID_vacunaciones) }}" class="btn-editar">✏️ Editar</a>

                        <form action="{{ route('vacunaciones.destroy', $v->ID_vacunaciones) }}" method="POST" onsubmit="return confirm('¿Eliminar esta vacunación?');">
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
