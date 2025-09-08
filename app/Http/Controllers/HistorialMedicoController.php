<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use App\Models\Mascota;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    // Mostrar listado de historial médico
    public function index()
    {
        $historiales = HistorialMedico::with('mascota')->latest()->paginate(10);
        return view('historial.index', compact('historiales'));
    }

    // Mostrar formulario para crear un historial
    public function create()
    {
        $mascotas = Mascota::all(); // Obtener todas las mascotas
        return view('historial.create', compact('mascotas'));
    }

    // Guardar nuevo historial
    public function store(Request $request)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'fecha_registro' => 'required|date',
            'descripcion' => 'required|string|max:500',
            'veterinario' => 'required|string|max:255',
        ]);

        HistorialMedico::create([
            'ID_mascota' => $request->ID_mascota,
            'fecha_registro' => $request->fecha_registro,
            'descripcion' => $request->descripcion,
            'veterinario' => $request->veterinario,
        ]);

        return redirect()->route('historial.index')->with('success', 'Historial médico registrado correctamente');
    }

    // Mostrar formulario de edición
    public function edit(HistorialMedico $historial)
    {
        $mascotas = Mascota::all();
        return view('historial.create', compact('historial', 'mascotas')); 
    }

    // Actualizar historial
    public function update(Request $request, HistorialMedico $historial)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'fecha_registro' => 'required|date',
            'descripcion' => 'required|string|max:500',
            'veterinario' => 'required|string|max:255',
        ]);

        $historial->update([
            'ID_mascota' => $request->ID_mascota,
            'fecha_registro' => $request->fecha_registro,
            'descripcion' => $request->descripcion,
            'veterinario' => $request->veterinario,
        ]);

        return redirect()->route('historial.index')->with('success', 'Historial médico actualizado correctamente');
    }

    // Eliminar historial
    public function destroy(HistorialMedico $historial)
    {
        $historial->delete();
        return redirect()->route('historial.index')->with('success', 'Historial médico eliminado correctamente');
    }
}
