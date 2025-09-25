<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\Reaccion;
use Illuminate\Support\Facades\Auth;

class ReaccionController extends Controller
{
    public function toggleLove(Publicacion $publicacion)
    {
        $user = auth()->user();

        // Verificar si el usuario ya reaccionó con 'love'
        $reaccion = $publicacion->reacciones()->where('user_id', $user->id)->where('tipo', 'love')->first();

        if ($reaccion) {
            // Si ya dio like, eliminarlo
            $reaccion->delete();
            $liked = false;
        } else {
            // Si no ha dado like, crearlo
            $publicacion->reacciones()->create([
                'user_id' => $user->id,
                'tipo' => 'love',
            ]);
            $liked = true;
        }

        // Contar todos los likes
        $count = $publicacion->reacciones()->where('tipo','love')->count();

        return response()->json([
            'liked' => $liked,
            'count' => $count,
        ]);
    }
}
