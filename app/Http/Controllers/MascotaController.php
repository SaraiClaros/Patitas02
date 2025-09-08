<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Dueno;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    // Mostrar listado de mascotas
    public function index()
    {
        // Mostrar todas las mascotas sin necesidad de login
        $mascotas = Mascota::all();

        return view('mascotas.index', compact('mascotas'));
    }

    // Formulario para registrar nueva mascota
    public function create()
    {
        $mascotas = null;
        $duenos = \App\Models\Dueno::all();
        return view('mascotas.create', compact('duenos'));
    }

    // Guardar mascota en BD
    public function store(Request $request)
    {
        $request->validate([
            'nombre_m' => 'required|string|max:255',
            'especie'  => 'required|string|max:50',
            'raza'     => 'required|string|max:50',
            'sexo'     => 'required|string|max:10',
            'edad'     => 'required|integer|min:0',
        ]);

        Mascota::create([
            'ID_dueno'   => $request->ID_dueno ?? null, // opcional, si quieres relacionarla
            'n_registro' => uniqid(),
            'nombre_m'   => $request->nombre_m,
            'especie'    => $request->especie,
            'raza'       => $request->raza,
            'sexo'       => $request->sexo,
            'edad'       => $request->edad
        ]);

        return redirect()->route('mascotas.index')->with('success', 'Mascota registrada correctamente');
    }

    // Mostrar formulario de edición
    public function edit(Mascota $mascotas)
    {
        return view('mascotas.create', compact('mascota')); // reutilizamos la vista create
    }

    // Actualizar datos de mascota
    public function update(Request $request, Mascota $mascotas)
    {
        $request->validate([
            'nombre_m' => 'required|string|max:255',
            'especie'  => 'required|string|max:50',
            'raza'     => 'required|string|max:50',
            'sexo'     => 'required|string|max:10',
            'edad'     => 'required|integer|min:0',
        ]);

        $mascotas->update([
            'nombre_m' => $request->nombre_m,
            'especie'  => $request->especie,
            'raza'     => $request->raza,
            'sexo'     => $request->sexo,
            'edad'     => $request->edad
        ]);

        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada correctamente');
    }

    // Eliminar mascota
    public function destroy(Mascota $mascotas)
    {
        $mascotas->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada correctamente');
    }
}
