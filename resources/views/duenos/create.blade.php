@extends('layouts.navigation')

@section('title', isset($dueno) ? 'Editar Dueño' : 'Registrar Dueño')

@section('content')
<div class="container p-4 rounded shadow-sm" style="background-color: #d2dfe3ff;">
    <h1 class="mb-4 text-center">{{ isset($dueno) ? 'Editar Dueño' : 'Registrar Nuevo Dueño' }}</h1>

    <div class="card w-50 mx-auto shadow"> 
        <div class="card-body">
            <form action="{{ isset($dueno) ? route('duenos.update', $dueno) : route('duenos.store') }}" method="POST">
                @csrf
                @if(isset($dueno))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre_d" class="form-control" value="{{ $dueno->nombre_d ?? old('nombre_d') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" value="{{ $dueno->apellidos ?? old('apellidos') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" value="{{ $dueno->correo ?? old('correo') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $dueno->telefono ?? old('telefono') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ $dueno->direccion ?? old('direccion') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">DUI</label>
                    <input type="text" name="dui" class="form-control" value="{{ $dueno->dui ?? old('dui') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('duenos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">{{ isset($dueno) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
