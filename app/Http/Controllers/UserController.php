<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function seguir(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id === $user->id) {
            return response()->json(['error' => 'No puedes seguirte a ti mismo.'], 400);
        }

        if ($authUser->siguiendo()->where('seguido_id', $user->id)->exists()) {
            $authUser->siguiendo()->detach($user->id); 
            $siguiendo = false;
        } else {
            $authUser->siguiendo()->attach($user->id); // seguir
            $siguiendo = true;
        }

        return response()->json([
            'siguiendo' => $siguiendo,
            'count' => $user->seguidores()->count()
        ]);
    }
}
