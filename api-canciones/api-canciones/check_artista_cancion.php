<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== VERIFICANDO RELACIONES ARTISTA-CANCIÓN ===\n";

try {
    $artistaCanciones = DB::select('SELECT * FROM artista_cancion LIMIT 10');
    echo "Relaciones encontradas: " . count($artistaCanciones) . "\n";
    
    foreach ($artistaCanciones as $rel) {
        echo "- Artista: {$rel->artista_id}, Canción: {$rel->cancion_id}\n";
    }
    
    if (count($artistaCanciones) == 0) {
        echo "\n¡PROBLEMA ENCONTRADO! No hay relaciones artista-canción en la base de datos.\n";
        echo "Esto explica por qué cancion.artistas está vacío.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
