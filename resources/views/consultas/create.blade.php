@extends('layouts.navigation')

@section('title', 'Registrar Consulta')

@section('content')
<div class="container p-4 rounded shadow-sm" style="background-color: #d2dfe3ff;">
    <h1 class="mb-4 text-center">{{ isset($consulta) ? 'Editar Consulta' : 'Registrar Nueva Consulta' }}</h1>

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

            <form action="{{ isset($consulta) ? route('consultas.update', $consulta->ID_consultas) : route('consultas.store') }}" method="POST">
                @csrf
                @if(isset($consulta))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Mascota</label>
                    <select name="ID_mascota" class="form-control" required>
                        <option value="">-- Seleccione una Mascota --</option>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->ID_mascota }}"
                                @if(isset($consulta) && $consulta->ID_mascota == $mascota->ID_mascota) selected @endif>
                                {{ $mascota->nombre_m }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de Cita</label>
                    <input type="date" name="fecha_cita" class="form-control" value="{{ $consulta->fecha_cita ?? old('fecha_cita') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Motivo</label>
                    <textarea name="motivo" class="form-control" rows="3" required>{{ $consulta->motivo ?? old('motivo') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Diagnóstico</label>
                    <textarea name="diagnostico" class="form-control" rows="3">{{ $consulta->diagnostico ?? old('diagnostico') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="Pendiente" @if(isset($consulta) && $consulta->estado == 'Pendiente') selected @endif>Pendiente</option>
                        <option value="Atendida" @if(isset($consulta) && $consulta->estado == 'Atendida') selected @endif>Atendida</option>
                        <option value="Cancelada" @if(isset($consulta) && $consulta->estado == 'Cancelada') selected @endif>Cancelada</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('consultas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">{{ isset($consulta) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
           </form>
        </div>
    </div>
</div>
@endsection
