@extends('layouts.navigation')

@section('title', 'Registrar Mascotas')

@section('content')
<div class="container p-4 rounded shadow-sm" style="background-color: #d2dfe3ff;">
    <h1 class="mb-4 text-center">{{ isset($mascota) ? 'Editar Mascota' : 'Registrar Nueva Mascota' }}</h1>

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

            <form action="{{ isset($mascota) ? route('mascotas.update', $mascota->ID_mascota) : route('mascotas.store') }}" method="POST">
                @csrf
                @if(isset($mascota))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Dueño</label>
                    <select name="ID_dueno" class="form-control" required>
                        <option value="">-- Seleccione un Dueño --</option>
                        @foreach($duenos as $dueno)
                            <option value="{{ $dueno->ID_dueno }}"
                                @if(isset($mascota) && $mascota->ID_dueno == $dueno->ID_dueno) selected @endif>
                                {{ $dueno->nombre_d }} {{ $dueno->apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">N° Registro</label>
                    <input type="text" name="n_registro" class="form-control" value="{{ old('n_registro', $mascota->n_registro ?? uniqid()) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre_m" class="form-control" value="{{ $mascota->nombre_m ?? old('nombre_m') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Especie</label>
                    <input type="text" name="especie" class="form-control" value="{{ $mascota->especie ?? old('especie') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Raza</label>
                    <input type="text" name="raza" class="form-control" value="{{ $mascota->raza ?? old('raza') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sexo</label>
                    <select name="sexo" class="form-control" required>
                        <option value="M" @if(isset($mascota) && $mascota->sexo == 'M') selected @endif>Macho</option>
                        <option value="F" @if(isset($mascota) && $mascota->sexo == 'F') selected @endif>Hembra</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad</label>
                    <input type="number" name="edad" class="form-control" value="{{ $mascota->edad ?? old('edad') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">{{ isset($mascota) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
           </form>
        </div>
    </div>
</div>
@endsection  