<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        return Usuario::all();
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|in:admin,cliente',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password, // El mutador encripta automáticamente
            'rol' => $request->rol,
        ]);

        return response()->json($usuario, 201);
    }

    // Mostrar un usuario por ID
    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    // Actualizar un usuario
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:usuarios,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'rol' => 'sometimes|in:admin,cliente',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->only(['nombre', 'email', 'password', 'rol']));

        return response()->json($usuario);
    }

    // Eliminar un usuario
    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['mensaje' => 'Usuario eliminado correctamente.']);
    }

    // Login de usuario
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $usuario = Usuario::where('email', $request->email)->first();

            if ($usuario && Hash::check($request->password, $usuario->password)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login exitoso',
                    'usuario' => [
                        'id' => $usuario->id,
                        'nombre' => $usuario->nombre,
                        'email' => $usuario->email,
                        'rol' => $usuario->rol,
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciales incorrectas'
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }

    // Cambiar contraseña de usuario
    public function changePassword(Request $request, $id)
    {
        try {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:6',
            ]);

            $usuario = Usuario::findOrFail($id);
            
            // Verificar contraseña actual
            if (!Hash::check($request->current_password, $usuario->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'La contraseña actual es incorrecta'
                ], 400);
            }

            // Actualizar contraseña
            $usuario->password = $request->new_password; // El mutador se encarga del hash
            $usuario->save();

            return response()->json([
                'success' => true,
                'message' => 'Contraseña actualizada exitosamente'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }
}