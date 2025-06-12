<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;


class ComentarioController extends Controller
{
    public function store(Request $request, Publicacion $publicacion)
{
    $request->validate([
        'contenido' => 'required|string',
    ]);

    $publicacion->comentarios()->create([
        'contenido' => $request->contenido,
        'user_id' => auth()->id(),
    ]);

    return back()->with('success', 'Comentario publicado');
}

}
