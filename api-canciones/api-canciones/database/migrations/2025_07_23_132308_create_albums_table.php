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
        Schema::create('albumes', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->date('fecha_lanzamiento');
    $table->string('urlSpotify')->nullable();
    $table->string('imagen')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albumes');
    }
};
