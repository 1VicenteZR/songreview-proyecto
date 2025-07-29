<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    // Mostrar todas las playlists (con filtro opcional por usuario_id)
    public function index(Request $request)
    {
        $query = Playlist::with('usuario');
        
        // Filtrar por usuario_id si viene en la query
        if ($request->has('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }
        
        return $query->get();
    }

    // Crear una nueva playlist
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $datos = [
            'nombre' => $request->nombre,
            'usuario_id' => $request->usuario_id ?? 1,
        ];

        if ($request->has('descripcion')) {
            $datos['descripcion'] = $request->descripcion;
        }

        $playlist = Playlist::create($datos);

        return response()->json($playlist, 201);
    }

    // Mostrar una playlist específica
    public function show(string $id)
    {
        $playlist = Playlist::with(['usuario', 'canciones'])->findOrFail($id);
        return response()->json($playlist);
    }

    // Actualizar una playlist
    public function update(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $playlist->update($request->only(['nombre', 'descripcion']));

        return response()->json($playlist->load('usuario'));
    }

    // Obtener canciones de una playlist específica
    public function canciones(string $id)
    {
        try {
            $playlist = Playlist::findOrFail($id);
            $canciones = $playlist->canciones;
            return response()->json($canciones);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Eliminar una playlist
    public function destroy(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();

        return response()->json(['mensaje' => 'Playlist eliminada correctamente.']);
    }
}
