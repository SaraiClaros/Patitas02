@extends('layouts.navigation')

@section('title', $campana ? 'Editar Campaña' : 'Crear Campaña')

@section('content')
<div class="container mt-4">
    <h2>{{ $campana ? 'Editar Campaña' : 'Crear Nueva Campaña' }}</h2>

    <form action="{{ $campana ? route('campanas.update', $campana->id_campana) : route('campanas.store') }}" method="POST">
        @csrf
        @if($campana)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input
                type="date"
                name="fecha_inicio"
                id="fecha_inicio"
                class="form-control"
                value="{{ old('fecha_inicio', $campana?->fecha_inicio?->format('Y-m-d')) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input
                type="date"
                name="fecha_fin"
                id="fecha_fin"
                class="form-control"
                value="{{ old('fecha_fin', $campana?->fecha_fin?->format('Y-m-d')) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea
                name="descripcion"
                id="descripcion"
                class="form-control"
            >{{ old('descripcion', $campana->descripcion ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="criterios" class="form-label">Criterios</label>
            <textarea
                name="criterios"
                id="criterios"
                class="form-control"
            >{{ old('criterios', $campana->criterios ?? '') }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                {{ $campana ? 'Actualizar' : 'Crear' }}
            </button>
            <a href="{{ route('campanas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
