<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Publicacion;

class PublicacionPolicy
{
    public function update(User $user, Publicacion $publicacion)
    {
        return $user->id === $publicacion->user_id;
    }

    public function delete(User $user, Publicacion $publicacion)
    {
        return $user->id === $publicacion->user_id;
    }
}
