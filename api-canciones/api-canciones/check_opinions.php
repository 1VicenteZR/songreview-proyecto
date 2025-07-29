<?php
require_once 'vendor/    echo "\nCanciones disponibles:\n";
    $canciones = DB::select('SELECT c.id, c.titulo, a.titulo as album FROM canciones c LEFT JOIN albumes a ON c.album_id = a.id LIMIT 10');
    foreach ($canciones as $cancion) {
        echo "- ID: {$cancion->id}, Título: {$cancion->titulo}, Álbum: {$cancion->album}\n";
    }
    
    echo "\nRelaciones artista-canción:\n";
    $artistaCanciones = DB::select('SELECT * FROM artista_cancion LIMIT 10');
    foreach ($artistaCanciones as $rel) {
        echo "- Artista: {$rel->artista_id}, Canción: {$rel->cancion_id}\n";
    }oad.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== VERIFICANDO DATOS EN CALIFICACION_CANCION ===\n";

try {
    // Verificar datos en la tabla
    $calificaciones = DB::select('SELECT * FROM calificacion_cancion');
    echo "Total de opiniones: " . count($calificaciones) . "\n\n";
    
    foreach ($calificaciones as $cal) {
        echo "ID: {$cal->id} | Usuario: {$cal->usuario_id} | Canción: {$cal->cancion_id} | Calificación: {$cal->calificacion} | Comentario: " . substr($cal->comentario ?? 'Sin comentario', 0, 50) . "\n";
    }
    
    echo "\n=== VERIFICANDO RELACIONES ===\n";
    
    // Verificar usuarios
    $usuarios = DB::select('SELECT id, nombre FROM usuarios');
    echo "Usuarios disponibles:\n";
    foreach ($usuarios as $user) {
        echo "- ID: {$user->id}, Nombre: {$user->nombre}\n";
    }
    
    echo "\nCanciones disponibles:\n";
    $canciones = DB::select('SELECT c.id, c.titulo, a.nombre as album FROM canciones c LEFT JOIN albumes a ON c.album_id = a.id LIMIT 10');
    foreach ($canciones as $cancion) {
        echo "- ID: {$cancion->id}, Título: {$cancion->titulo}, Álbum: {$cancion->album}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
