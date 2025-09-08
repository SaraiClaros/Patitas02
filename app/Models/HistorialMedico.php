<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medico'; 
    protected $primaryKey = 'ID_historial'; 
    public $timestamps = false;

    protected $fillable = [
        'ID_mascota',
        'fecha_registro',
        'descripcion',
        'veterinario',
    ];

    // ✅ Relación con Mascota
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'ID_mascota', 'ID_mascota');
    }
}
