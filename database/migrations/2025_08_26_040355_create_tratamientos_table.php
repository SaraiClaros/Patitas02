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
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id('ID_tratamientos');
            $table->unsignedBigInteger('ID_mascota');
            $table->string('tratamiento');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->text('observaciones')->nullable();
            $table->foreign('ID_mascota')->references('ID_mascota')->on('mascotas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
