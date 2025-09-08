<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampanaEsterilizacion extends Model
{
    use HasFactory;

    protected $table = 'campana_esterilizacion';
    protected $primaryKey = 'id_campana';

    protected $fillable = [
        'user_id',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'criterios',
    ];

    // Convertir fechas automáticamente a Carbon
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin'    => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    // Relación con el usuario que creó la campaña
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con solicitudes (opcional)
    public function solicitudes()
    {
        return $this->hasMany(SolicitudCE::class, 'campana_id', 'id_campana');
    }
}
