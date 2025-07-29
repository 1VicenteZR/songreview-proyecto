<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== VERIFICANDO TABLAS DE CALIFICACION ===\n";

try {
    $tables = DB::select("SHOW TABLES LIKE '%calificacion%'");
    echo "Tablas encontradas:\n";
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "- $tableName\n";
        
        // Mostrar estructura de la tabla
        $columns = DB::select("DESCRIBE $tableName");
        echo "  Estructura:\n";
        foreach ($columns as $column) {
            echo "    - {$column->Field} ({$column->Type})\n";
        }
        echo "\n";
    }
    
    echo "=== VERIFICANDO MODELO ===\n";
    if (class_exists('App\Models\CalificacionCancion')) {
        echo "✓ Modelo CalificacionCancion existe\n";
        $model = new App\Models\CalificacionCancion();
        echo "  - Tabla: {$model->getTable()}\n";
        echo "  - Fillable: " . implode(', ', $model->getFillable()) . "\n";
    } else {
        echo "✗ Modelo CalificacionCancion NO existe\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
