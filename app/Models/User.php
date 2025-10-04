<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function publicaciones()
    {
    return $this->hasMany(Publicacion::class);
    }


    public function comentarios()
    {
    return $this->hasMany(Comentario::class);
    }

    public function reacciones()
    {
    return $this->hasMany(Reaccion::class);
    }

    public function duenos()
    {
        return $this->hasMany(Dueno::class);
    }

    public function compartidos() {
    return $this->hasMany(Compartido::class);
    }

    
  // Usuario que sigo
    public function siguiendo()
    {
        return $this->belongsToMany(User::class, 'seguidores', 'user_id', 'seguido_id');
    }

// Usuarios que me siguen
    public function seguidores()
    {
        return $this->belongsToMany(User::class, 'seguidores', 'seguido_id', 'user_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    // Mensajes que este usuario recibió
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

}




