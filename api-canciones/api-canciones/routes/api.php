<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CancionController;
use App\Http\Controllers\CalificacionAlbumController;
use App\Http\Controllers\CalificacionCancionController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PlaylistCancionController;
use App\Http\Controllers\ArtistaCancionController;


// Rutas OPTIONS para CORS
Route::options('{any}', function () {
    return response('', 200);
})->where('any', '.*');

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('artistas', ArtistaController::class);
Route::apiResource('albumes', AlbumController::class);
Route::apiResource('canciones', CancionController::class);
Route::apiResource('calificaciones-album', CalificacionAlbumController::class);
Route::apiResource('calificaciones-cancion', CalificacionCancionController::class);
Route::apiResource('playlists', PlaylistController::class);
Route::apiResource('playlist-canciones', PlaylistCancionController::class);
Route::apiResource('artista-cancion', ArtistaCancionController::class);

// Rutas específicas para playlists
Route::get('playlists/{id}/canciones', [PlaylistController::class, 'canciones']);
Route::delete('playlist-canciones/{playlist}/{cancion}', [PlaylistCancionController::class, 'destroyByIds']);

// Rutas personalizadas
Route::get('artistas/{id}/canciones', [ArtistaController::class, 'canciones']);
Route::get('buscar', [ArtistaController::class, 'buscar']);

// Rutas de autenticación
Route::post('login', [UsuarioController::class, 'login']); // Ruta simple
Route::post('usuarios/login', [UsuarioController::class, 'login']); // Ruta alternativa
Route::post('usuarios/register', [UsuarioController::class, 'store']);
Route::put('usuarios/{id}/password', [UsuarioController::class, 'changePassword']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
