<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id('ID_mascota');
            $table->foreignId('ID_dueno')->constrained('duenos')->onDelete('cascade');
            $table->string('n_registro')->unique();
            $table->string('nombre_m');
            $table->string('especie');
            $table->string('raza')->nullable();
            $table->string('sexo', 1);
            $table->integer('edad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
