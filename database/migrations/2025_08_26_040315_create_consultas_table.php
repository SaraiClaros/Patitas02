<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id('ID_consultas');
            $table->unsignedBigInteger('ID_mascota');
            $table->date('fecha_cita');
            $table->string('motivo');
            $table->string('diagnostico')->nullable();
            $table->string('estado')->default('pendiente');
            $table->foreign('ID_mascota')->references('ID_mascota')->on('mascotas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
    $table->id('ID_consultas');
    $table->unsignedBigInteger('ID_mascota');
    $table->date('fecha_cita');
    $table->string('motivo');
    $table->text('diagnostico')->nullable();
    $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('pendiente');
    $table->timestamps();

    $table->foreign('ID_mascota')->references('ID_mascota')->on('mascotas')->onDelete('cascade');
    });
    
    }
};
