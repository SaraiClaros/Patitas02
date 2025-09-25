<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SeguirController extends Controller
{
    /**
     * Alternar seguir / dejar de seguir a un usuario
     */
    public function toggle(User $user)
    {
        $authUser = auth()->user();

        // Verificar si ya sigue al usuario
        $estaSiguiendo = $authUser->siguiendo()->where('seguido_id', $user->id)->exists();

        if ($estaSiguiendo) {
            // Dejar de seguir
            $authUser->siguiendo()->detach($user->id);
            $siguiendo = false;
        } else {
            // Seguir
            $authUser->siguiendo()->attach($user->id);
            $siguiendo = true;
        }

        // Contar seguidores actualizados del usuario seguido
        $count = $user->seguidores()->count();

        // Devolver JSON igual que tu AJAX
        return response()->json([
            'siguiendo' => $siguiendo,
            'count' => $count,
        ]);
    }
}
