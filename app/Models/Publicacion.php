<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'media',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comentarios()
    
    {
    return $this->hasMany(Comentario::class);
    }

    public function reacciones()
    {
        return $this->hasMany(Reaccion::class);
    }

    public function reaccionesLove()
    {
        return $this->reacciones()->where('tipo', 'love');
    }


}
