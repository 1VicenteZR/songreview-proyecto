<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== VERIFICANDO DATOS PARA CALIFICACIÓN ===\n";

// Verificar usuarios
$usuarios = DB::table('usuarios')->get();
echo "Usuarios en la tabla:\n";
foreach ($usuarios as $usuario) {
    echo "- ID: {$usuario->id}, Nombre: {$usuario->nombre}\n";
}

echo "\n";

// Verificar canciones
$canciones = DB::table('canciones')->get();
echo "Canciones en la tabla:\n";
foreach ($canciones as $cancion) {
    echo "- ID: {$cancion->id}, Título: {$cancion->titulo}\n";
}

echo "\n";

// Verificar calificaciones existentes
$calificaciones = DB::table('calificacion_cancion')->get();
echo "Calificaciones existentes:\n";
foreach ($calificaciones as $cal) {
    echo "- Usuario: {$cal->usuario_id}, Canción: {$cal->cancion_id}, Calificación: {$cal->calificacion}\n";
}
