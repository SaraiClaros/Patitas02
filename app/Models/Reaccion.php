<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reaccion extends Model
{
    protected $fillable = ['user_id','publicacion_id','tipo'];
    public function publicacion() { return $this->belongsTo(Publicacion::class); }
    public function user() { return $this->belongsTo(User::class); }
}
