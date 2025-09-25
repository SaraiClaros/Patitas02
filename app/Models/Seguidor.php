<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    protected $fillable = ['user_id', 'seguido_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seguido() {
        return $this->belongsTo(User::class, 'seguido_id');
    }
}
