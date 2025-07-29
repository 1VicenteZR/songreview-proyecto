<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistaCancionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = DB::table('artista_cancion');
            
            // Si se proporciona artista_id como parámetro, filtrar por él
            if ($request->has('artista_id')) {
                $query->where('artista_id', $request->artista_id);
            }
            
            $relaciones = $query->get();
            
            return response()->json($relaciones, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener relaciones artista-cancion',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'artista_id' => 'required|exists:artistas,id',
                'cancion_id' => 'required|exists:canciones,id'
            ]);

            $relacionId = DB::table('artista_cancion')->insertGetId([
                'artista_id' => $request->artista_id,
                'cancion_id' => $request->cancion_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $relacion = DB::table('artista_cancion')->where('id', $relacionId)->first();

            return response()->json($relacion, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear relación artista-cancion',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $relacion = DB::table('artista_cancion')->where('id', $id)->first();
            
            if (!$relacion) {
                return response()->json(['message' => 'Relación no encontrada'], 404);
            }

            return response()->json($relacion, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener relación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = DB::table('artista_cancion')->where('id', $id)->delete();
            
            if (!$deleted) {
                return response()->json(['message' => 'Relación no encontrada'], 404);
            }

            return response()->json(['message' => 'Relación eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar relación',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
