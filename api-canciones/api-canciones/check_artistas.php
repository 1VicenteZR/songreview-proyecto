<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== VERIFICANDO ESTRUCTURA DE TABLA ARTISTAS ===\n";

try {
    // Verificar si la columna imagen existe
    $hasImagen = Schema::hasColumn('artistas', 'imagen');
    echo "¿Tiene columna 'imagen'? " . ($hasImagen ? "SÍ" : "NO") . "\n\n";
    
    // Mostrar estructura de la tabla
    $columns = DB::select('DESCRIBE artistas');
    echo "Estructura de la tabla:\n";
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type})\n";
    }
    
    echo "\n=== DATOS DE ARTISTAS ===\n";
    $artistas = DB::select('SELECT id, nombre, imagen, urlSpotify FROM artistas');
    
    foreach ($artistas as $artista) {
        echo "ID: {$artista->id}\n";
        echo "  Nombre: {$artista->nombre}\n";
        echo "  Imagen: " . ($artista->imagen ?: 'Sin imagen') . "\n";
        echo "  URL Spotify: " . ($artista->urlSpotify ?: 'Sin URL') . "\n\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
