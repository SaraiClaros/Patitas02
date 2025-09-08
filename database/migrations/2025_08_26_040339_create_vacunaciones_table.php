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
         Schema::create('vacunaciones', function (Blueprint $table) {
            $table->id('ID_vacunaciones');
            $table->unsignedBigInteger('ID_mascota');
            $table->string('nombre_vacuna');
            $table->date('fecha_aplicacion');
            $table->date('proxima_dosis')->nullable();
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
        Schema::dropIfExists('vacunaciones');
    }
};
