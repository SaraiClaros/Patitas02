<?php

namespace App\Http\Controllers;

use App\Models\SolicitudCE;
use App\Models\CampanaEsterilizacion;
use Illuminate\Http\Request;

class SolicitudCEController extends Controller
{
    
    public function index()
    {
        $solicitudes = SolicitudCE::with('campana')->latest()->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    // Formulario de nueva solicitud (HU-018)
    public function create()
    {
        // Campañas activas (dentro del rango de fechas)
        $campanas = CampanaEsterilizacion::whereDate('fecha_inicio', '<=', now())
                                         ->whereDate('fecha_fin', '>=', now())
                                         ->get();

        return view('solicitudes.create', compact('campanas'));
    }

    // Guardar solicitud
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_campana'      => 'required|exists:campana_esterilizacion,id_campana',
            'nombre_dueno'    => 'required|string|max:100',
            'correo'          => 'required|email|max:100',
            'estado_economico'=> 'nullable|string|max:50',
            'nombre_mascota'  => 'required|string|max:100',
            'especie'         => 'nullable|string|max:50',
            'raza'            => 'nullable|string|max:50',
            'sexo'            => 'nullable|in:Macho,Hembra',
            'fecha'           => 'required|date',
            'descripcion'     => 'nullable|string',
        ]);

        SolicitudCE::create($validated);

        return redirect()->route('solicitudes.index')
                         ->with('success', 'Solicitud enviada correctamente.');
    }

    // Mostrar solicitud
    public function show(SolicitudCE $solicitud)
    {
        $solicitud->load('campana');
        return view('solicitudes.show', compact('solicitud'));
    }

    // Formulario editar solicitud
    public function edit(SolicitudCE $solicitud)
    {
        $campanas = CampanaEsterilizacion::all();
        return view('solicitudes.create', compact('solicitud', 'campanas'));
    }

    // Actualizar solicitud
    public function update(Request $request, SolicitudCE $solicitud)
    {
        $validated = $request->validate([
            'id_campana'      => 'required|exists:campana_esterilizacion,id_campana',
            'nombre_dueno'    => 'required|string|max:100',
            'correo'          => 'required|email|max:100',
            'estado_economico'=> 'nullable|string|max:50',
            'nombre_mascota'  => 'required|string|max:100',
            'especie'         => 'nullable|string|max:50',
            'raza'            => 'nullable|string|max:50',
            'sexo'            => 'nullable|in:Macho,Hembra',
            'fecha'           => 'required|date',
            'descripcion'     => 'nullable|string',
        ]);

        $solicitud->update($validated);

        return redirect()->route('solicitudes.index')
                         ->with('success', 'Solicitud actualizada correctamente.');
    }

    // Eliminar solicitud
    public function destroy(SolicitudCE $solicitud)
    {
        $solicitud->delete();

        return redirect()->route('solicitudes.index')
                         ->with('success', 'Solicitud eliminada.');
    }
}
