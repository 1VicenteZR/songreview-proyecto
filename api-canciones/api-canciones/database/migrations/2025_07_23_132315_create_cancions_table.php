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
        Schema::create('canciones', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->string('urlSpotify')->nullable();
    $table->foreignId('album_id')->constrained('albumes')->onDelete('cascade');
    $table->integer('duracion'); // En segundos
    $table->string('ruta_audio')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canciones');
    }
};
