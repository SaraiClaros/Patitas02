<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    public function index()
    {
        
        $publicaciones = Auth::user()->publicaciones()->latest()->get();
        return view('publicaciones.index', compact('publicaciones'));
    }

    public function create()
    {
        return view('publicaciones.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $imagenPath = null;

    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('publicaciones', 'public');
    }

    Publicacion::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'imagen' => $imagenPath,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('publicaciones.index')->with('success', 'Publicación creada correctamente.');
}

}
