@extends('layouts.navigation')

@section('title', 'Registrar Tratamiento')

@section('content')
<div class="container p-4 rounded shadow-sm" style="background-color: #d2dfe3ff;">
    <h1 class="mb-4 text-center">{{ isset($tratamiento) ? 'Editar Tratamiento' : 'Registrar Nuevo Tratamiento' }}</h1>

    <div class="card w-50 mx-auto shadow">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($tratamiento) ? route('tratamientos.update', $tratamiento->ID_tratamientos) : route('tratamientos.store') }}" method="POST">
                @csrf
                @if(isset($tratamiento))
                    @method('PUT')
                @endif

                <!-- Mascota -->
                <div class="mb-3">
                    <label class="form-label">Mascota</label>
                    <select name="ID_mascota" class="form-control" required>
                        <option value="">-- Seleccione una Mascota --</option>
                        @foreach($mascotas as $m)
                            <option value="{{ $m->ID_mascota }}"
                                @if(isset($tratamiento) && $tratamiento->ID_mascota == $m->ID_mascota) selected @endif>
                                {{ $m->nombre_m }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombre del Tratamiento -->
                <div class="mb-3">
                    <label class="form-label">Tratamiento</label>
                    <input type="text" name="tratamiento" class="form-control"
                        value="{{ $tratamiento->tratamiento ?? old('tratamiento') }}" required>
                </div>

                <!-- Fecha Inicio -->
                <div class="mb-3">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control"
                        value="{{ $tratamiento->fecha_inicio ?? old('fecha_inicio') }}" required>
                </div>

                <!-- Fecha Fin -->
                <div class="mb-3">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control"
                        value="{{ $tratamiento->fecha_fin ?? old('fecha_fin') }}">
                </div>

                <!-- Observaciones -->
                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3">{{ $tratamiento->observaciones ?? old('observaciones') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">{{ isset($tratamiento) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
