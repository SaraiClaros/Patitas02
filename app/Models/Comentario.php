<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    protected $fillable = ['contenido','user_id','publicacion_id'];

    public function user() { return $this->belongsTo(User::class); }
    public function publicacion() { return $this->belongsTo(Publicacion::class); }
}
