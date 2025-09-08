<?php

namespace App\Http\Controllers;

use App\Models\Dueno;
use Illuminate\Http\Request;

class DuenoController extends Controller
{
    // Mostrar formulario de creación
    public function create()
    {
        return view('duenos.create');
    }

    // Guardar nuevo dueño (sin necesidad de estar logueado)
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre_d' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|unique:duenos,correo',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'dui' => 'required|string|unique:duenos,dui',
        ]);

        // Crear dueño sin user_id (porque no hay usuario autenticado)
        Dueno::create([
            'nombre_d' => $request->nombre_d,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'dui' => $request->dui,
        ]);

        return redirect()->route('duenos.index')->with('success', 'Dueño registrado correctamente');
    }

    // Mostrar lista de dueños
    public function index()
    {
        $duenos = Dueno::all();
        return view('duenos.index', compact('duenos'));
    }

   public function edit(Dueno $dueno)
{
    return view('duenos.create', compact('dueno')); // Reutilizamos create
}

public function update(Request $request, Dueno $dueno)
{
    $request->validate([
        'nombre_d' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'correo' => 'required|email|max:255',
        'telefono' => 'nullable|string|max:20',
        'dui' => 'required|string|max:20',
    ]);

    $dueno->update($request->all());

    return redirect()->route('duenos.index')->with('success', 'Dueño actualizado correctamente');
}

    // Eliminar dueño
    public function destroy(Dueno $dueno)
    {
        $dueno->delete();
        return redirect()->route('duenos.index')->with('success', 'Dueño eliminado correctamente');
    }
}
