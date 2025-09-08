@extends('layouts.navigation')

@section('title', 'Solicitudes de Campaña de Esterilización')

@section('content')
<div class="container mt-4">
    <h2>Listado de Solicitudes para Campaña de Esterilización</h2>
    <hr>

    {{-- Botón crear --}}
    <a href="{{ route('solicitudes.create') }}" class="btn btn-primary mb-3">➕ Nueva Solicitud</a>

    {{-- Mostrar mensajes --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabla --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dueño</th>
                <th>Correo</th>
                <th>Mascota</th>
                <th>Campaña</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id_solicitud }}</td>
                    <td>{{ $solicitud->nombre_dueno }}</td>
                    <td>{{ $solicitud->correo }}</td>
                    <td>{{ $solicitud->nombre_mascota }} ({{ $solicitud->especie }})</td>
                    <td>{{ $solicitud->campana->descripcion ?? 'N/A' }}</td>
                    <td>{{ $solicitud->fecha }}</td>
                    <td>
                        <a href="{{ route('solicitudes.show', $solicitud->id_solicitud) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                        <a href="{{ route('solicitudes.edit', $solicitud->id_solicitud) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <form action="{{ route('solicitudes.destroy', $solicitud->id_solicitud) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar solicitud?')">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay solicitudes registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
