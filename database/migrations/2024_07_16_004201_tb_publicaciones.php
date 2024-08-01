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
        Schema::create('tb_publicaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_usuario');
            $table->string('titulo');
            $table->string('comentario');
            $table->date('fecha');
            $table->binary('foto_publi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_publicaciones');
    }
};
