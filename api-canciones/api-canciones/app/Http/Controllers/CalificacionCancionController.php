<?php

namespace App\Http\Controllers;

use App\Models\CalificacionCancion;
use App\Mail\ComentarioEliminadoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CalificacionCancionController extends Controller
{
    // Mostrar todas las calificaciones de canciones (con filtros opcionales)
    public function index(Request $request)
    {
        $query = CalificacionCancion::with([
            'usuario', 
            'cancion.artistas', 
            'cancion.album.artistas'
        ]);
        
        // Filtrar por usuario_id si viene en la query
        if ($request->has('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }
        
        // Filtrar por cancion_id si viene en la query
        if ($request->has('cancion_id')) {
            $query->where('cancion_id', $request->cancion_id);
        }
        
        return $query->get();
    }

    // Crear una nueva calificación
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'usuario_id' => 'required|integer|exists:usuarios,id',
                'cancion_id' => 'required|integer|exists:canciones,id',
                'valor' => 'required|integer|min:1|max:5',
                'comentario' => 'required|string|min:10|max:1000'
            ]);

            // Convertir 'valor' a 'calificacion' para que coincida con la base de datos
            $dataToCreate = [
                'usuario_id' => $validatedData['usuario_id'],
                'cancion_id' => $validatedData['cancion_id'],
                'calificacion' => $validatedData['valor'], // Conversión aquí
                'comentario' => $validatedData['comentario']
            ];

            // Verificar si ya existe una calificación para evitar duplicados
            $existe = CalificacionCancion::where('usuario_id', $dataToCreate['usuario_id'])
                                       ->where('cancion_id', $dataToCreate['cancion_id'])
                                       ->first();

            if ($existe) {
                return response()->json(['error' => 'Ya has calificado esta canción'], 409);
            }

            $calificacion = CalificacionCancion::create($dataToCreate);
            $calificacion->load(['usuario', 'cancion']);
            
            return response()->json($calificacion, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Devolver errores de validación detallados
            return response()->json([
                'error' => 'Datos de validación incorrectos',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Capturar otros errores
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    // Mostrar una calificación específica
    public function show(string $id)
    {
        $calificacion = CalificacionCancion::with(['usuario', 'cancion'])->findOrFail($id);
        return response()->json($calificacion);
    }

    // Actualizar una calificación
    public function update(Request $request, string $id)
    {
        $calificacion = CalificacionCancion::findOrFail($id);

        $request->validate([
            'valor' => 'sometimes|numeric|min:0.5|max:5',
            'comentario' => 'nullable|string|max:500',
        ]);

        $calificacion->update($request->only(['valor', 'comentario']));

        return response()->json($calificacion->load(['usuario', 'cancion']));
    }

    // Eliminar una calificación
    public function destroy(string $id)
    {
        try {
            $comentario = CalificacionCancion::with(['usuario', 'cancion.album', 'cancion.artistas'])->find($id);
            
            if (!$comentario) {
                return response()->json([
                    'message' => 'Comentario no encontrado'
                ], 404);
            }

            // Datos para el email
            $usuario = $comentario->usuario;
            $cancion = $comentario->cancion;
            $comentarioData = $comentario->toArray();

            Log::info('Enviando email de comentario eliminado', [
                'usuario_id' => $usuario->id,
                'comentario_id' => $comentario->id,
                'email' => $usuario->email
            ]);

            // Enviar email con PDF
            try {
                Mail::to($usuario->email)->send(new ComentarioEliminadoMail($usuario, $comentarioData, $cancion));
                Log::info('Email enviado exitosamente', ['email' => $usuario->email]);
            } catch (\Exception $mailException) {
                Log::error('Error al enviar email:', [
                    'error' => $mailException->getMessage(),
                    'email' => $usuario->email
                ]);
                // Continuar con la eliminación aunque falle el email
            }

            // Eliminar el comentario
            $comentario->delete();

            return response()->json([
                'message' => 'Comentario eliminado exitosamente y notificación enviada'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar comentario:', [
                'error' => $e->getMessage(),
                'comentario_id' => $id
            ]);
            
            return response()->json([
                'message' => 'Error al eliminar comentario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
