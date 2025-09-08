<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacunacion extends Model
{
    use HasFactory;

    protected $table = 'vacunaciones'; 
    protected $primaryKey = 'ID_vacunaciones'; 
    protected $fillable = [
        'ID_mascota',
        'nombre_vacuna',
        'fecha_aplicacion',
        'proxima_dosis',
        'observaciones',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'ID_mascota', 'ID_mascota');
    }
}
