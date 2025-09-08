<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';
    protected $primaryKey = 'ID_consultas';

    protected $fillable = [
        'ID_mascota', 'fecha_cita', 'motivo', 'diagnostico', 'estado'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'ID_mascota');
    }
    
    public function index()
    {
    $consultas = Consulta::all();
    return view('consultas.index', compact('consultas'));
    }




}
