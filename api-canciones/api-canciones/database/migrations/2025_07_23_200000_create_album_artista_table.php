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
        Schema::create('album_artista', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained('albumes')->onDelete('cascade');
            $table->foreignId('artista_id')->constrained('artistas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_artista');
    }
};
