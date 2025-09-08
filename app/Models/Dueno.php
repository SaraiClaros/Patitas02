<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dueno extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional, Laravel lo infiere de "duenos")
    protected $table = 'duenos';

    // Clave primaria personalizada
    protected $primaryKey = 'ID_dueno';

    // Permitir asignación masiva (mass assignment)
    protected $fillable = [
        'nombre_d',
        'apellidos',
        'correo',
        'telefono',
        'direccion',
        'dui',
        
    ];

    
}
