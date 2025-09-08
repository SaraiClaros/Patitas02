@extends('layouts.navigation')

@section('title', 'Registrar Dueño')

@section('content')
<div class="container p-4 rounded shadow-sm" style="background-color: #d2dfe3ff;">
    <h1 class="mb-4 text-center">Registrar Nuevo Dueño</h1>

    <div class="card w-50 mx-auto shadow"> 
        <div class="card-body">
            <form action="{{ route('duenos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre_d" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">DUI</label>
                    <input type="text" name="dui" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('duenos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection   