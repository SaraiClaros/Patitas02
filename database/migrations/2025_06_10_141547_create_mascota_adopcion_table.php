<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mascota_adopcion', function (Blueprint $table) {
             $table->id('ID_mascota_adop'); 
            $table->string('foto');
            $table->string('nombre');
            $table->string('especie');
            $table->string('raza');
            $table->string('edad');
            $table->string('sexo'); 
            $table->string('estado_salud');
            $table->date('fecha_registro');
            $table->string('estado_adopcion'); 
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascota_adopcion');
    }
};
