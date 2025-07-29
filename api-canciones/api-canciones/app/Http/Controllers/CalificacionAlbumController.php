<?php

namespace App\Http\Controllers;

use App\Models\CalificacionAlbum;
use Illuminate\Http\Request;

class CalificacionAlbumController extends Controller
{
    // Mostrar todas las calificaciones de álbumes
    public function index()
    {
        return CalificacionAlbum::with(['usuario', 'album'])->get();
    }

    // Crear una nueva calificación
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'album_id' => 'required|exists:albums,id',
            'valor' => 'required|numeric|min:0.5|max:5',
            'comentario' => 'nullable|string|max:500',
        ]);

        // Crear o actualizar la calificación si ya existe
        $calificacion = CalificacionAlbum::updateOrCreate(
            [
                'usuario_id' => $request->usuario_id,
                'album_id' => $request->album_id,
            ],
            [
                'valor' => $request->valor,
                'comentario' => $request->comentario,
            ]
        );

        return response()->json($calificacion->load(['usuario', 'album']), 201);
    }

    // Mostrar una calificación específica
    public function show(string $id)
    {
        $calificacion = CalificacionAlbum::with(['usuario', 'album'])->findOrFail($id);
        return response()->json($calificacion);
    }

    // Actualizar una calificación
    public function update(Request $request, string $id)
    {
        $calificacion = CalificacionAlbum::findOrFail($id);

        $request->validate([
            'valor' => 'sometimes|numeric|min:0.5|max:5',
            'comentario' => 'nullable|string|max:500',
        ]);

        $calificacion->update($request->only(['valor', 'comentario']));

        return response()->json($calificacion->load(['usuario', 'album']));
    }

    // Eliminar una calificación
    public function destroy(string $id)
    {
        $calificacion = CalificacionAlbum::findOrFail($id);
        $calificacion->delete();

        return response()->json(['mensaje' => 'Calificación eliminada correctamente.']);
    }
}
