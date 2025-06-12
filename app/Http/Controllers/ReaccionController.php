<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\Reaccion;

class ReaccionController extends Controller
{
    public function toggleLove(Publicacion $publicacion)
    {
        $user = auth()->user();

        $reaccion = $publicacion->reacciones()
            ->where('user_id', $user->id)
            ->where('tipo', 'love')
            ->first();

        if ($reaccion) {
            $reaccion->delete(); 
        } else {
            $publicacion->reacciones()->create([
                'user_id' => $user->id,
                'tipo' => 'love',
            ]);
        }

        return back();
    }
}
