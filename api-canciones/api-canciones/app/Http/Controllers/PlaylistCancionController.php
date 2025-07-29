<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\PlaylistCancion;
use Illuminate\Http\Request;

class PlaylistCancionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
            'cancion_id' => 'required|exists:canciones,id',
        ]);

        $playlist = Playlist::findOrFail($request->playlist_id);
        
        // Verificar si la canción ya está en la playlist
        if ($playlist->canciones()->where('cancion_id', $request->cancion_id)->exists()) {
            return response()->json([
                'message' => 'La canción ya existe en esta playlist'
            ], 400);
        }

        // Agregar la canción a la playlist
        $playlist->canciones()->attach($request->cancion_id);

        return response()->json([
            'message' => 'Canción agregada a la playlist correctamente',
            'playlist_id' => $request->playlist_id,
            'cancion_id' => $request->cancion_id
        ], 201);
    }

    /**
     * Remove by single ID (para apiResource)
     */
    public function destroy(string $id)
    {
        // Buscar por ID único
        $relacion = PlaylistCancion::findOrFail($id);
        $relacion->delete();

        return response()->json([
            'message' => 'Canción eliminada de la playlist correctamente'
        ]);
    }

    /**
     * Remove by playlist and cancion IDs (método personalizado)
     */
    public function destroyByIds($playlistId, $cancionId)
    {
        $playlist = Playlist::findOrFail($playlistId);
        
        // Verificar si la canción está en la playlist
        if (!$playlist->canciones()->where('cancion_id', $cancionId)->exists()) {
            return response()->json([
                'message' => 'La canción no está en esta playlist'
            ], 404);
        }

        // Eliminar la canción de la playlist
        $playlist->canciones()->detach($cancionId);

        return response()->json([
            'message' => 'Canción eliminada de la playlist correctamente'
        ]);
    }
}
