<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{
    public function store(Request $request)
    {
        // Debug logging
        Log::info('Datos recibidos para álbum:', $request->all());
        if ($request->hasFile('imagen')) {
            Log::info('Archivo de imagen recibido:', [
                'name' => $request->file('imagen')->getClientOriginalName(),
                'type' => $request->file('imagen')->getMimeType(),
                'size' => $request->file('imagen')->getSize()
            ]);
        }

        // Validación de datos
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'fecha_lanzamiento' => 'nullable|date',
            'urlSpotify' => 'nullable|url',
            'imagen' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'artista_ids' => 'required|array|min:1',
            'artista_ids.*' => 'required|integer|exists:artistas,id'
        ]);

        if ($validator->fails()) {
            Log::error('Error de validación en álbum:', $validator->errors()->toArray());
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Crear el álbum
            $album = new Album();
            $album->titulo = $request->titulo;
            $album->fecha_lanzamiento = $request->fecha_lanzamiento;
            $album->urlSpotify = $request->urlSpotify ?? '';

            // Procesar imagen si existe
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                
                // Crear nombre único para la imagen
                $nombreImagen = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $imagen->getClientOriginalName());
                
                // Crear directorio assets si no existe
                $assetsPath = public_path('assets');
                if (!file_exists($assetsPath)) {
                    mkdir($assetsPath, 0755, true);
                }
                
                // Mover imagen a assets
                $imagen->move($assetsPath, $nombreImagen);
                $album->imagen = 'assets/' . $nombreImagen;
                
                Log::info('Imagen de álbum guardada:', ['ruta' => $album->imagen]);
            }

            $album->save();

            // Asociar artistas al álbum
            $album->artistas()->attach($request->artista_ids);

            // Cargar las relaciones para la respuesta
            $album->load('artistas');

            Log::info('Álbum creado exitosamente:', ['id' => $album->id, 'titulo' => $album->titulo]);

            return response()->json([
                'message' => 'Álbum creado exitosamente',
                'album' => $album
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error al crear álbum:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'message' => 'Error al crear álbum',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $query = Album::with(['artistas', 'canciones']);
            
            // Filtrar por artista_id si viene en la query
            if ($request->has('artista_id')) {
                $query->whereHas('artistas', function ($q) use ($request) {
                    $q->where('artista_id', $request->artista_id);
                });
            }
            
            return response()->json($query->get());
        } catch (\Exception $e) {
            Log::error('Error al obtener álbumes:', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Error al obtener álbumes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mostrar un álbum específico
    public function show(string $id)
    {
        try {
            $album = Album::with(['artistas', 'canciones'])->findOrFail($id);
            return response()->json($album);
        } catch (\Exception $e) {
            Log::error('Error al obtener álbum:', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Álbum no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    // Actualizar un álbum
    public function update(Request $request, string $id)
    {
        try {
            $album = Album::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'titulo' => 'sometimes|string|max:255',
                'fecha_lanzamiento' => 'sometimes|date',
                'urlSpotify' => 'sometimes|url',
                'imagen' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
                'artista_ids' => 'sometimes|array|min:1',
                'artista_ids.*' => 'required|integer|exists:artistas,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Actualizar campos básicos
            if ($request->has('titulo')) $album->titulo = $request->titulo;
            if ($request->has('fecha_lanzamiento')) $album->fecha_lanzamiento = $request->fecha_lanzamiento;
            if ($request->has('urlSpotify')) $album->urlSpotify = $request->urlSpotify;

            // Procesar imagen si se envía una nueva
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $imagen->getClientOriginalName());
                
                $assetsPath = public_path('assets');
                if (!file_exists($assetsPath)) {
                    mkdir($assetsPath, 0755, true);
                }
                
                $imagen->move($assetsPath, $nombreImagen);
                $album->imagen = 'assets/' . $nombreImagen;
            }

            $album->save();

            // Actualizar artistas si se proporcionan
            if ($request->has('artista_ids')) {
                $album->artistas()->sync($request->artista_ids);
            }

            return response()->json([
                'message' => 'Álbum actualizado exitosamente',
                'album' => $album->load('artistas')
            ]);

        } catch (\Exception $e) {
            Log::error('Error al actualizar álbum:', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Error al actualizar álbum',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Eliminar un álbum
    public function destroy(string $id)
    {
        try {
            $album = Album::findOrFail($id);
            
            // Desasociar artistas antes de eliminar
            $album->artistas()->detach();
            
            $album->delete();

            return response()->json(['message' => 'Álbum eliminado correctamente.']);
        } catch (\Exception $e) {
            Log::error('Error al eliminar álbum:', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Error al eliminar álbum',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
