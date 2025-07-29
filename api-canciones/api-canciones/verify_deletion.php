<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== VERIFICANDO ELIMINACIÓN DEL ÁLBUM ===\n";

try {
    // Verificar que no exista el álbum con ID 4
    $album = DB::select('SELECT * FROM albumes WHERE id = 4');
    echo "¿Existe álbum con ID 4? " . (count($album) > 0 ? "SÍ" : "NO") . "\n";
    
    // Verificar que las relaciones en la tabla pivot también se eliminaron
    $relaciones = DB::select('SELECT * FROM album_artista WHERE album_id = 4');
    echo "¿Existen relaciones para álbum ID 4? " . (count($relaciones) > 0 ? "SÍ" : "NO") . "\n";
    
    echo "\nRelaciones actuales en album_artista:\n";
    $todasRelaciones = DB::select('SELECT * FROM album_artista');
    foreach ($todasRelaciones as $rel) {
        echo "- Album: {$rel->album_id}, Artista: {$rel->artista_id}\n";
    }
    
    if (count($todasRelaciones) == 0) {
        echo "- No hay relaciones en la tabla\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
