<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('campana_esterilizacion', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        $table->id('id_campana');
        $table->date('fecha_inicio');
        $table->date('fecha_fin');
        $table->text('descripcion')->nullable();
        $table->text('criterios')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('campana_esterilizacion');
}

};
