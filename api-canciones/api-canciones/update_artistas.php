<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Artista;
use Illuminate\Support\Facades\DB;

echo "=== ELIMINANDO ARTISTA SIN DATOS ===\n";

try {
    // Verificar el artista 8 antes de eliminarlo
    $artista8 = Artista::find(8);
    if ($artista8) {
        echo "Artista 8 encontrado:\n";
        echo "  ID: {$artista8->id}\n";
        echo "  Nombre: {$artista8->nombre}\n";
        echo "  Imagen: " . ($artista8->imagen ?: 'Sin imagen') . "\n";
        echo "  Descripción: " . ($artista8->descripcion ?: 'Sin descripción') . "\n\n";
        
        // Eliminar el artista 8
        $artista8->delete();
        echo "✅ Artista 8 eliminado.\n\n";
    } else {
        echo "❌ Artista 8 no encontrado.\n\n";
    }
    
    // Verificar el artista 9
    $artista9 = Artista::find(9);
    if ($artista9) {
        echo "Artista 9 encontrado:\n";
        echo "  ID: {$artista9->id}\n";
        echo "  Nombre: {$artista9->nombre}\n";
        echo "  Imagen: " . ($artista9->imagen ?: 'Sin imagen') . "\n\n";
        
        // Cambiar el ID del artista 9 a 8
        // Primero desactivar las restricciones de clave foránea temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('UPDATE artistas SET id = 8 WHERE id = 9');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        echo "✅ ID del artista cambiado de 9 a 8.\n\n";
    } else {
        echo "❌ Artista 9 no encontrado.\n\n";
    }
    
    // Verificar los cambios
    echo "=== VERIFICANDO CAMBIOS ===\n";
    $artistas = Artista::whereIn('id', [8, 9])->get(['id', 'nombre', 'imagen']);
    
    if ($artistas->count() > 0) {
        foreach ($artistas as $artista) {
            echo "ID: {$artista->id}, Nombre: {$artista->nombre}, Imagen: " . ($artista->imagen ?: 'Sin imagen') . "\n";
        }
    } else {
        echo "No se encontraron artistas con ID 8 o 9.\n";
    }
    
    echo "\n=== LISTADO FINAL DE ARTISTAS ===\n";
    $todosArtistas = Artista::orderBy('id')->get(['id', 'nombre']);
    foreach ($todosArtistas as $artista) {
        echo "ID: {$artista->id} - {$artista->nombre}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
