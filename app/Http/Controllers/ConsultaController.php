<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Mascota;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with('mascota')->get();
        return view('consultas.index', compact('consultas'));
    }

    public function create()
    {
        $mascotas = Mascota::all();
        return view('consultas.create', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'fecha_cita' => 'required|date',
            'motivo' => 'required',
            'estado' => 'required',
        ]);

        Consulta::create($request->all());
        return redirect()->route('consultas.index')->with('success', 'Consulta registrada.');
    }
}
