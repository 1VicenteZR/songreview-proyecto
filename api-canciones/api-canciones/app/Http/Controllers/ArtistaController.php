<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistaController extends Controller
{
    // Mostrar todos los artistas
    public function index()
    {
        return Artista::all();
    }

    // Crear un nuevo artista
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urlSpotify' => 'nullable|url',
        ]);

        $data = $request->only(['nombre', 'descripcion', 'urlSpotify']);

        // Procesar imagen si existe
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Crear directorio assets si no existe
            $assetsPath = public_path('assets');
            if (!file_exists($assetsPath)) {
                mkdir($assetsPath, 0755, true);
            }
            
            // Mover imagen a assets
            $imagen->move($assetsPath, $nombreImagen);
            $data['imagen'] = 'assets/' . $nombreImagen;
        } else {
            $data['imagen'] = $request->input('imagen', '');
        }

        $artista = Artista::create($data);

        return response()->json($artista, 201);
    }

    // Mostrar un artista específico
    public function show(string $id)
    {
        $artista = Artista::findOrFail($id);
        return response()->json($artista);
    }

    // Actualizar un artista
    public function update(Request $request, string $id)
    {
        $artista = Artista::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urlSpotify' => 'nullable|url',
        ]);

        $data = $request->only(['nombre', 'descripcion', 'urlSpotify']);

        // Procesar imagen si existe
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($artista->imagen && file_exists(public_path($artista->imagen))) {
                unlink(public_path($artista->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Crear directorio assets si no existe
            $assetsPath = public_path('assets');
            if (!file_exists($assetsPath)) {
                mkdir($assetsPath, 0755, true);
            }
            
            // Mover imagen a assets
            $imagen->move($assetsPath, $nombreImagen);
            $data['imagen'] = 'assets/' . $nombreImagen;
        } elseif ($request->has('imagen')) {
            $data['imagen'] = $request->input('imagen');
        }

        $artista->update($data);

        return response()->json($artista);
    }

    // Eliminar un artista
    public function destroy(string $id)
    {
        $artista = Artista::findOrFail($id);
        $artista->delete();

        return response()->json(['mensaje' => 'Artista eliminado correctamente.']);
    }

    /**
     * Obtener todas las canciones de un artista específico
     */
    public function canciones($id)
    {
        try {
            // Verificar que el artista existe
            $artista = Artista::find($id);
            
            if (!$artista) {
                return response()->json(['message' => 'Artista no encontrado'], 404);
            }

            // Obtener las canciones del artista usando la tabla de relación
            $canciones = DB::table('canciones')
                ->join('artista_cancion', 'canciones.id', '=', 'artista_cancion.cancion_id')
                ->where('artista_cancion.artista_id', $id)
                ->select('canciones.*')
                ->get();

            return response()->json($canciones, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener canciones del artista',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Búsqueda inteligente por artista, álbum o canción
     * Busca en múltiples campos con términos parciales
     */
    public function buscar(Request $request)
    {
        try {
            $termino = $request->query('q');
            
            if (!$termino || strlen(trim($termino)) < 2) {
                return response()->json(['message' => 'El término de búsqueda debe tener al menos 2 caracteres'], 400);
            }

            // Dividir el término en palabras para búsqueda más flexible
            $palabras = explode(' ', trim($termino));
            
            $resultados = [];

            // 1. Buscar artistas
            $queryArtistas = DB::table('artistas');
            foreach ($palabras as $palabra) {
                if (strlen($palabra) >= 2) {
                    $queryArtistas->where('nombre', 'LIKE', '%' . $palabra . '%');
                }
            }
            $artistas = $queryArtistas->get();

            foreach ($artistas as $artista) {
                $resultados[] = [
                    'tipo' => 'artista',
                    'id' => $artista->id,
                    'nombre' => $artista->nombre,
                    'descripcion' => $artista->descripcion,
                    'imagen' => $artista->imagen,
                    'urlSpotify' => $artista->urlSpotify,
                    'coincidencia' => 'artista'
                ];
            }

            // 2. Buscar álbumes
            $queryAlbumes = DB::table('albums')
                ->join('artistas', 'albums.artista_id', '=', 'artistas.id')
                ->select('albums.*', 'artistas.nombre as nombre_artista');
            
            foreach ($palabras as $palabra) {
                if (strlen($palabra) >= 2) {
                    $queryAlbumes->where(function($query) use ($palabra) {
                        $query->where('albums.nombre', 'LIKE', '%' . $palabra . '%')
                              ->orWhere('artistas.nombre', 'LIKE', '%' . $palabra . '%');
                    });
                }
            }
            $albumes = $queryAlbumes->get();

            foreach ($albumes as $album) {
                $resultados[] = [
                    'tipo' => 'album',
                    'id' => $album->id,
                    'nombre' => $album->nombre,
                    'descripcion' => $album->descripcion,
                    'imagen' => $album->imagen,
                    'fecha_lanzamiento' => $album->fecha_lanzamiento,
                    'artista_id' => $album->artista_id,
                    'nombre_artista' => $album->nombre_artista,
                    'coincidencia' => 'album'
                ];
            }

            // 3. Buscar canciones
            $queryCanciones = DB::table('canciones')
                ->join('albums', 'canciones.album_id', '=', 'albums.id')
                ->join('artistas', 'albums.artista_id', '=', 'artistas.id')
                ->select(
                    'canciones.*',
                    'albums.nombre as nombre_album',
                    'artistas.nombre as nombre_artista',
                    'artistas.id as artista_id'
                );

            foreach ($palabras as $palabra) {
                if (strlen($palabra) >= 2) {
                    $queryCanciones->where(function($query) use ($palabra) {
                        $query->where('canciones.nombre', 'LIKE', '%' . $palabra . '%')
                              ->orWhere('albums.nombre', 'LIKE', '%' . $palabra . '%')
                              ->orWhere('artistas.nombre', 'LIKE', '%' . $palabra . '%');
                    });
                }
            }
            $canciones = $queryCanciones->get();

            foreach ($canciones as $cancion) {
                $resultados[] = [
                    'tipo' => 'cancion',
                    'id' => $cancion->id,
                    'nombre' => $cancion->nombre,
                    'duracion' => $cancion->duracion,
                    'numero_pista' => $cancion->numero_pista,
                    'letra' => $cancion->letra,
                    'album_id' => $cancion->album_id,
                    'nombre_album' => $cancion->nombre_album,
                    'artista_id' => $cancion->artista_id,
                    'nombre_artista' => $cancion->nombre_artista,
                    'coincidencia' => 'cancion'
                ];
            }

            // 4. También buscar relaciones artista-canción directas
            $queryRelaciones = DB::table('artista_cancion')
                ->join('canciones', 'artista_cancion.cancion_id', '=', 'canciones.id')
                ->join('artistas', 'artista_cancion.artista_id', '=', 'artistas.id')
                ->join('albums', 'canciones.album_id', '=', 'albums.id')
                ->select(
                    'canciones.*',
                    'albums.nombre as nombre_album',
                    'artistas.nombre as nombre_artista',
                    'artistas.id as artista_id'
                );

            foreach ($palabras as $palabra) {
                if (strlen($palabra) >= 2) {
                    $queryRelaciones->where(function($query) use ($palabra) {
                        $query->where('canciones.nombre', 'LIKE', '%' . $palabra . '%')
                              ->orWhere('artistas.nombre', 'LIKE', '%' . $palabra . '%');
                    });
                }
            }
            $relacionesCanciones = $queryRelaciones->get();

            foreach ($relacionesCanciones as $cancion) {
                // Evitar duplicados
                $existe = false;
                foreach ($resultados as $resultado) {
                    if ($resultado['tipo'] === 'cancion' && $resultado['id'] === $cancion->id) {
                        $existe = true;
                        break;
                    }
                }
                
                if (!$existe) {
                    $resultados[] = [
                        'tipo' => 'cancion',
                        'id' => $cancion->id,
                        'nombre' => $cancion->nombre,
                        'duracion' => $cancion->duracion,
                        'numero_pista' => $cancion->numero_pista,
                        'letra' => $cancion->letra,
                        'album_id' => $cancion->album_id,
                        'nombre_album' => $cancion->nombre_album,
                        'artista_id' => $cancion->artista_id,
                        'nombre_artista' => $cancion->nombre_artista,
                        'coincidencia' => 'colaboracion'
                    ];
                }
            }

            return response()->json([
                'termino_busqueda' => $termino,
                'total_resultados' => count($resultados),
                'resultados' => $resultados
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error en la búsqueda',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
