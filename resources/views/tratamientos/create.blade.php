@extends('layouts.navigation')

@section('title', isset($tratamiento) ? 'Editar Tratamiento' : 'Registrar Tratamiento')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ isset($tratamiento) ? 'Editar Tratamiento' : 'Registrar Nuevo Tratamiento' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($tratamiento) ? route('tratamientos.update', $tratamiento->ID_tratamiento) : route('tratamientos.store') }}" method="POST">
        @csrf
        @if(isset($tratamiento))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Mascota</label>
            <select name="ID_mascota" class="form-control" required>
                <option value="">-- Seleccione una Mascota --</option>
                @foreach($mascotas as $mascota)
                    <option value="{{ $mascota->ID_mascota }}" 
                        @if(isset($tratamiento) && $tratamiento->ID_mascota == $mascota->ID_mascota) selected @endif>
                        {{ $mascota->nombre_m }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tratamiento</label>
            <input type="text" name="tratamiento" class="form-control" 
                   value="{{ $tratamiento->tratamiento ?? old('tratamiento') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" 
                   value="{{ $tratamiento->fecha_inicio ?? old('fecha_inicio') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" 
                   value="{{ $tratamiento->fecha_fin ?? old('fecha_fin') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ $tratamiento->observaciones ?? old('observaciones') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($tratamiento) ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
