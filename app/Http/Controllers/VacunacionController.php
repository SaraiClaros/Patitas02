<?php

namespace App\Http\Controllers;

use App\Models\Vacunacion;
use App\Models\Mascota;
use Illuminate\Http\Request;

class VacunacionController extends Controller
{
    // Mostrar listado de vacunaciones
    public function index()
    {
        $vacunaciones = Vacunacion::with('mascota')->latest()->paginate(10);
        return view('vacunaciones.index', compact('vacunaciones'));
    }

    // Formulario para crear una vacunación
    public function create()
    {
        $mascotas = Mascota::all(); // Todas las mascotas disponibles
        return view('vacunaciones.create', compact('mascotas'));
    }

    // Guardar nueva vacunación
    public function store(Request $request)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'nombre_vacuna' => 'required|string|max:255',
            'fecha_aplicacion' => 'required|date',
            'proxima_dosis' => 'nullable|date',
            'observaciones' => 'nullable|string|max:500',
        ]);

        Vacunacion::create([
            'ID_mascota' => $request->ID_mascota,
            'nombre_vacuna' => $request->nombre_vacuna,
            'fecha_aplicacion' => $request->fecha_aplicacion,
            'proxima_dosis' => $request->proxima_dosis,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('vacunaciones.index')->with('success', 'Vacunación registrada correctamente');
    }

    // Mostrar formulario de edición
    public function edit(Vacunacion $vacunacion)
    {
        $mascotas = Mascota::all();
        return view('vacunaciones.create', compact('vacunacion', 'mascotas')); // reutilizamos create
    }

    // Actualizar vacunación
    public function update(Request $request, Vacunacion $vacunacion)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'nombre_vacuna' => 'required|string|max:255',
            'fecha_aplicacion' => 'required|date',
            'proxima_dosis' => 'nullable|date',
            'observaciones' => 'nullable|string|max:500',
        ]);

        $vacunacion->update([
            'ID_mascota' => $request->ID_mascota,
            'nombre_vacuna' => $request->nombre_vacuna,
            'fecha_aplicacion' => $request->fecha_aplicacion,
            'proxima_dosis' => $request->proxima_dosis,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('vacunaciones.index')->with('success', 'Vacunación actualizada correctamente');
    }

    // Eliminar vacunación
    public function destroy(Vacunacion $vacunacion)
    {
        $vacunacion->delete();
        return redirect()->route('vacunaciones.index')->with('success', 'Vacunación eliminada correctamente');
    }
}
