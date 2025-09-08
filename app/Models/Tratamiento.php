<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamientos';
    protected $primaryKey = 'ID_tratamientos';

    protected $fillable = [
        'ID_mascota', 'tratamiento', 'fecha_inicio', 'fecha_fin', 'observaciones'
    ];

   public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'ID_mascota', 'ID_mascota');
    }
}
