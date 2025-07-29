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
        Schema::table('calificacion_cancion', function (Blueprint $table) {
            // Agregar el campo comentario
            $table->text('comentario')->nullable();
            
            // Renombrar la columna calificacion a valor
            $table->renameColumn('calificacion', 'valor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calificacion_cancion', function (Blueprint $table) {
            // Eliminar el campo comentario
            $table->dropColumn('comentario');
            
            // Renombrar de vuelta valor a calificacion
            $table->renameColumn('valor', 'calificacion');
        });
    }
};
