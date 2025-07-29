<?php

namespace App\Http\Controllers;

use App\Models\Cancion;
use Illuminate\Http\Request;

class CancionController extends Controller
{
    // Mostrar todas las canciones
    public function index()
    {
        return Cancion::with('artistas')->get();
    }

    // Crear una nueva canción
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'urlSpotify' => 'nullable|url',
            'duracion' => 'required|integer',
            'ruta_audio' => 'nullable|string',
            'album_id' => 'required|integer|exists:albumes,id',
            'artista_ids' => 'sometimes|array',
            'artista_ids.*' => 'exists:artistas,id',
            'artista_id' => 'sometimes|integer|exists:artistas,id',
        ]);

        $cancion = Cancion::create([
            'titulo' => $request->titulo,
            'urlSpotify' => $request->urlSpotify,
            'duracion' => $request->duracion,
            'ruta_audio' => $request->ruta_audio,
            'album_id' => $request->album_id,
        ]);

        // Permitir artista_id (entero) o artista_ids (array)
        if ($request->filled('artista_ids')) {
            $cancion->artistas()->attach($request->artista_ids);
        } elseif ($request->filled('artista_id')) {
            $cancion->artistas()->attach([$request->artista_id]);
        }

        return response()->json($cancion->load('artistas'), 201);
    }

    // Mostrar una canción específica
    public function show(string $id)
    {
        $cancion = Cancion::with('artistas')->findOrFail($id);
        return response()->json($cancion);
    }

    // Actualizar una canción
    public function update(Request $request, string $id)
    {
        $cancion = Cancion::findOrFail($id);

        $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'urlSpotify' => 'nullable|url',
            'duracion' => 'sometimes|integer',
            'ruta_audio' => 'nullable|string',
            'album_id' => 'sometimes|integer|exists:albumes,id',
            'artista_ids' => 'nullable|array',
            'artista_ids.*' => 'exists:artistas,id',
            'artista_id' => 'nullable|integer|exists:artistas,id',
        ]);

        $cancion->update($request->only(['titulo', 'urlSpotify', 'duracion', 'ruta_audio', 'album_id']));

        if ($request->has('artista_ids')) {
            $cancion->artistas()->sync($request->artista_ids);
        } elseif ($request->has('artista_id')) {
            $cancion->artistas()->sync([$request->artista_id]);
        }

        return response()->json($cancion->load('artistas'));
    }

    // Eliminar una canción
    public function destroy(string $id)
    {
        $cancion = Cancion::findOrFail($id);
        $cancion->artistas()->detach();
        $cancion->delete();

        return response()->json(['mensaje' => 'Canción eliminada correctamente.']);
    }
}
