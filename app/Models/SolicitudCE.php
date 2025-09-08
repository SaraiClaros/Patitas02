<?php

namespace App\Models;

class SolicitudCE extends Model
{
    protected $table = 'solicitud_ce';
    protected $primaryKey = 'id_solicitud';

    protected $fillable = [
        'id_campana',
        'nombre_dueno',
        'correo',
        'estado_economico',
        'nombre_mascota',
        'especie',
        'raza',
        'sexo',
        'fecha',
        'descripcion',
    ];

    public function campana()
    {
        return $this->belongsTo(CampanaEsterilizacion::class, 'id_campana', 'id_campana');
    }
}
