<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== VERIFICANDO TABLA PIVOT album_artista ===\n";

try {
    // Verificar si la tabla existe
    $exists = Schema::hasTable('album_artista');
    echo "¿Existe tabla album_artista? " . ($exists ? "SÍ" : "NO") . "\n\n";
    
    if ($exists) {
        // Mostrar estructura de la tabla
        $columns = DB::select('DESCRIBE album_artista');
        echo "Estructura de la tabla:\n";
        foreach ($columns as $column) {
            echo "- {$column->Field} ({$column->Type})\n";
        }
        
        // Mostrar datos existentes
        echo "\nDatos existentes:\n";
        $data = DB::select('SELECT * FROM album_artista LIMIT 5');
        foreach ($data as $row) {
            echo "- Album: {$row->album_id}, Artista: {$row->artista_id}\n";
        }
        
        if (count($data) == 0) {
            echo "- No hay datos en la tabla\n";
        }
    } else {
        echo "❌ La tabla album_artista NO existe. Necesita ser creada.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
