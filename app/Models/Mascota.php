<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';
    protected $primaryKey = 'ID_mascota';

    protected $fillable = [
        'ID_dueno', 'n_registro', 'nombre_m', 'especie', 'raza', 'sexo', 'edad'
    ];

    public function dueno()
{
    return $this->belongsTo(Dueno::class, 'ID_dueno', 'ID_dueno');
}

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'ID_mascota');
    }

    public function historialMedicos()
    {
        return $this->hasMany(HistorialMedico::class, 'ID_mascota', 'ID_mascota');
    }

    public function vacunaciones()
    {
        return $this->hasMany(Vacunacion::class, 'ID_mascota', 'ID_mascota');
    }

    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'ID_mascota');
    }
}
