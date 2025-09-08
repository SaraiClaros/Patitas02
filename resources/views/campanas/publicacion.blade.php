@extends('layouts.navigation')

@section('title', 'Campañas de Esterilización Disponibles')

@section('content')
<div class="container mt-4">
    <h2>Campañas de Esterilización Disponibles</h2>
    <hr>

    @forelse ($campanas as $campana)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">📅 {{ $campana->fecha_inicio->format('d/m/Y') }} → {{ $campana->fecha_fin->format('d/m/Y') }}</h4>
                
                <p class="card-text"><strong>Descripción:</strong> {{ $campana->descripcion }}</p>
                <p class="card-text"><strong>Criterios:</strong> {{ $campana->criterios }}</p>
                <p class="card-text"><strong>Publicado por:</strong> {{ $campana->user->name ?? 'Desconocido' }}</p>
                <p class="card-text"><small class="text-muted">Publicado: {{ $campana->created_at->format('d/m/Y H:i') }}</small></p>

                <a href="{{ route('solicitudes.create') }}" class="btn btn-primary mt-2">Enviar Solicitud</a>
            </div>
        </div>
    @empty
        <p>No hay campañas disponibles por el momento.</p>
    @endforelse
</div>
@endsection
