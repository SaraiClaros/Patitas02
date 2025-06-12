<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MascotaAdopcion extends Model
{
     protected $table = 'mascota_adopcion'; 
    protected $fillable = [
        'nombre',
        'foto',
        'especie',
        'raza',
        'edad',
        'sexo',
        'estado_salud',
        'fecha_registro',
        'estado_adopcion',
        'descripcion',
    ];
}
