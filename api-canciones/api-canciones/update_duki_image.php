<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Artista;

echo "=== ACTUALIZANDO IMAGEN DE DUKI ===\n";

try {
    $duki = Artista::where('nombre', 'duki')->first();
    
    if ($duki) {
        echo "Artista duki encontrado:\n";
        echo "  ID: {$duki->id}\n";
        echo "  Nombre: {$duki->nombre}\n";
        echo "  Imagen anterior: {$duki->imagen}\n";
        
        // Actualizar la imagen
        $duki->imagen = 'assets/duki.jpg';
        $duki->save();
        
        echo "  Imagen nueva: {$duki->imagen}\n";
        echo "✅ Imagen actualizada correctamente.\n";
        
    } else {
        echo "❌ Artista duki no encontrado.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
