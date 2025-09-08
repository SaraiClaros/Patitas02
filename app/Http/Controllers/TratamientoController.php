<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Mascota;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    // Listado de tratamientos
    public function index()
    {
        $tratamientos = Tratamiento::with('mascota')->latest()->paginate(10);
        return view('tratamientos.index', compact('tratamientos'));
    }

    // Formulario para crear tratamiento
    public function create()
    {
        $mascotas = Mascota::all(); // Para el select de mascotas
        $tratamientos = Tratamiento::with('mascota')->latest()->get(); // Para mostrar en la misma vista si quieres
        return view('tratamientos.create', compact('mascotas', 'tratamientos'));
    }

    // Guardar tratamiento
    public function store(Request $request)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'tratamiento' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string|max:500',
        ]);

        Tratamiento::create([
            'ID_mascota' => $request->ID_mascota,
            'tratamiento' => $request->tratamiento,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento registrado correctamente');
    }

    // Formulario de edición
    public function edit(Tratamiento $tratamiento)
    {
        $mascotas = Mascota::all();
        return view('tratamientos.create', compact('tratamiento', 'mascotas')); // Reutilizamos create
    }

    // Actualizar tratamiento
    public function update(Request $request, Tratamiento $tratamiento)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'tratamiento' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string|max:500',
        ]);

        $tratamiento->update($request->only('ID_mascota', 'tratamiento', 'fecha_inicio', 'fecha_fin', 'observaciones'));

        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento actualizado correctamente');
    }

    // Eliminar tratamiento
    public function destroy(Tratamiento $tratamiento)
    {
        $tratamiento->delete();
        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento eliminado correctamente');
    }
}
