<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MensajesController extends Controller
{
        public function index(Request $request)
    {
        $search = $request->input('search', '');

        $user = auth()->user();

        // Todos los usuarios que sigo
        $followingUsers = $user->siguiendo()->get();

        // Usuarios que coinciden con la búsqueda (excepto yo)
        $allMatchingUsers = User::where('id', '!=', $user->id)
                                ->where('name', 'like', "%{$search}%")
                                ->get();

        // Separar los usuarios que sigo de los que no sigo
        $followingMatching = $allMatchingUsers->intersect($followingUsers);
        $otherMatching = $allMatchingUsers->diff($followingUsers);

        // Combinar: primero los que sigo, luego el resto
        $allUsers = $followingMatching->concat($otherMatching);

        return view('mensajes', compact('followingUsers', 'allUsers', 'search'));
    }

}
