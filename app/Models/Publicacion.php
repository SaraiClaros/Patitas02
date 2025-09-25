<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $fillable = ['titulo','descripcion','media','user_id'];

    public function user() { return $this->belongsTo(User::class); }
    public function comentarios() { return $this->hasMany(Comentario::class)->latest(); }
    public function reacciones() { return $this->hasMany(Reaccion::class); }
    public function reaccionesLove() { return $this->hasMany(Reaccion::class)->where('tipo','love'); }

    public function comentariosRecientes($limite = 2)
{
    return $this->comentarios()->latest()->take($limite);
}

// Publicaciones compartidas
public function compartidos()
{
    return $this->hasMany(Compartido::class, 'publicacion_id');
}

// Usuarios que compartieron esta publicación
public function usuariosQueComparten()
{
    return $this->belongsToMany(User::class, 'compartidos', 'publicacion_id', 'user_id');
}


}
