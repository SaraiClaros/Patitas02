@extends('layouts.navigation')

@section('title', 'Registrar Historial')

@section('content')
<div class="container p-4 rounded shadow-sm" style="background-color: #d2dfe3ff;">
    <h1 class="mb-4 text-center">{{ isset($historial) ? 'Editar Registro Médico' : 'Registrar Nuevo Historial' }}</h1>

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

            <form action="{{ isset($historial) ? route('historial.update', $historial->ID_Hmedico) : route('historial.store') }}" method="POST">
                @csrf
                @if(isset($historial))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Mascota</label>
                    <select name="ID_mascota" class="form-control" required>
                        <option value="">-- Seleccione una Mascota --</option>
                        @foreach($mascotas as $m)
                            <option value="{{ $m->ID_mascota }}"
                                @if(isset($historial) && $historial->ID_mascota == $m->ID_mascota) selected @endif>
                                {{ $m->nombre_m }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha_registro" class="form-control" 
                        value="{{ $historial->fecha_registro ?? old('fecha_registro') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" required>{{ $historial->descripcion ?? old('descripcion') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Veterinario</label>
                    <input type="text" name="veterinario" class="form-control" 
                        value="{{ $historial->veterinario ?? old('veterinario') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('historial.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">{{ isset($historial) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
