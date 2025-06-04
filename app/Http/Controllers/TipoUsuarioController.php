<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoUsuarioController extends Controller
{
    // Mostrar formulario para seleccionar tipo de usuario
    public function show()
    {
        return view('auth.seleccionar-tipo');
    }

    // Guardar el tipo de usuario seleccionado
    public function store(Request $request)
    {
        // Validar que se haya seleccionado un tipo de usuario válido
        $request->validate([
            'tipo_usuario' => 'required|in:veterinaria,refugio,usuario',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        if ($user) {
            $user->tipo_usuario = $request->input('tipo_usuario');
            $user->save();

            // Redirigir al login u otra vista si ya completó el registro
            return redirect()->route('login')->with('success', 'Tipo de usuario guardado exitosamente.');
        }

        return back()->withErrors(['No se encontró el usuario.']);
    }
}
