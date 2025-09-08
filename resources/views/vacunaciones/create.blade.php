@extends('layouts.navigation')

@section('title', 'Registrar Vacunación')

@section('content')
<div class="container p-4 rounded shadow-sm" style="background-color: #d2dfe3ff;">
    <h1 class="mb-4 text-center">{{ isset($vacunacione) ? 'Editar Vacunación' : 'Registrar Nueva Vacunación' }}</h1>

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

            <form action="{{ isset($vacunacione) ? route('vacunaciones.update', $vacunacione->ID_vacunaciones) : route('vacunaciones.store') }}" method="POST">
                @csrf
                @if(isset($vacunacione))
                    @method('PUT')
                @endif

                <!-- Mascota -->
                <div class="mb-3">
                    <label class="form-label">Mascota</label>
                    <select name="ID_mascota" class="form-control" required>
                        <option value="">-- Seleccione una Mascota --</option>
                        @foreach($mascotas as $m)
                            <option value="{{ $m->ID_mascota }}"
                                @if(isset($vacunacione) && $vacunacione->ID_mascota == $m->ID_mascota) selected @endif>
                                {{ $m->nombre_m }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombre de la Vacuna -->
                <div class="mb-3">
                    <label class="form-label">Nombre de la Vacuna</label>
                    <input type="text" name="nombre_vacuna" class="form-control"
                        value="{{ $vacunacione->nombre_vacuna ?? old('nombre_vacuna') }}" required>
                </div>

                <!-- Fecha Aplicación -->
                <div class="mb-3">
                    <label class="form-label">Fecha de Aplicación</label>
                    <input type="date" name="fecha_aplicacion" class="form-control"
                        value="{{ $vacunacione->fecha_aplicacion ?? old('fecha_aplicacion') }}" required>
                </div>

                <!-- Próxima Dosis -->
                <div class="mb-3">
                    <label class="form-label">Próxima Dosis</label>
                    <input type="date" name="proxima_dosis" class="form-control"
                        value="{{ $vacunacione->proxima_dosis ?? old('proxima_dosis') }}">
                </div>

                <!-- Observaciones -->
                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3">{{ $vacunacion->observaciones ?? old('observaciones') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('vacunaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">{{ isset($vacunacione) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
