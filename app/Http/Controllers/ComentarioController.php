<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;


class ComentarioController extends Controller
{
    public function store(Request $request, Publicacion $publicacion)
{
    $request->validate([
        'contenido' => 'required|string|max:500',
    ]);

    $comentario = $publicacion->comentarios()->create([
        'user_id' => auth()->id(),
        'contenido' => $request->contenido,
    ]);

    if ($request->ajax()) {
        return response()->json([
            'id' => $comentario->id,
            'user_name' => $comentario->user->name,
            'contenido' => $comentario->contenido,
        ]);
    }

    return redirect()->back();
}

}
