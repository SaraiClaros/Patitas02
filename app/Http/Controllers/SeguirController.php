<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SeguirController extends Controller
{
        public function toggle(User $user)
    {
        $authUser = auth()->user();

        // Evitar seguirse a sí mismo
        if ($authUser->id === $user->id) {
            return response()->json([
                'error' => 'No puedes seguirte a ti mismo.'
            ], 422);
        }

        if ($authUser->siguiendo()->where('seguido_id', $user->id)->exists()) {
            $authUser->siguiendo()->detach($user->id);
            $siguiendo = false;
        } else {
            $authUser->siguiendo()->attach($user->id);
            $siguiendo = true;
        }

        return response()->json([
            'siguiendo' => $siguiendo,
            'count' => $user->seguidores()->count(),
        ]);
    }

}
