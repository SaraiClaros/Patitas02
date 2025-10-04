<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // quien envía
            $table->unsignedBigInteger('receiver_id'); // quien recibe
            $table->text('body')->nullable(); // puede ser null si solo envías un archivo
            $table->string('file_path')->nullable(); // ruta del archivo
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('messages');
    }
};