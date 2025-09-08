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
       Schema::create('historial_medico', function (Blueprint $table) {
            $table->id('ID_Hmedico');
            $table->unsignedBigInteger('ID_mascota');
            $table->date('fecha_registro');
            $table->text('descripcion');
            $table->string('veterinario');
            $table->foreign('ID_mascota')->references('ID_mascota')->on('mascotas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_medico');
    }
};
