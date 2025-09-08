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
        Schema::create('duenos', function (Blueprint $table) {
        $table->id('ID_dueno');
        $table->string('nombre_d');
        $table->string('apellidos');
        $table->string('correo')->unique();
        $table->string('telefono');
        $table->string('direccion');
        $table->string('dui')->unique();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duenos');
    }
};
