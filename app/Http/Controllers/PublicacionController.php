<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::with('user')->latest()->get();
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
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm|max:20480' // 20MB máximo
        ]);

        $mediaPath = null;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $mediaPath = $file->store('publicaciones', 'public');
        }

        Publicacion::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'media' => $mediaPath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('publicaciones.index')->with('success', 'Publicación creada correctamente.');
    }
}
