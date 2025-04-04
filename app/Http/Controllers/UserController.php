<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listar()
    {
        $usuarios = Usuario::all();
        return view('usuarios.listar', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'required|string|max:255',
            'telefonos' => 'required|array',
            'telefonos.*' => 'string',
            'correo' => 'required|string|email|max:255|unique:usuarios,correo',
            'edad' => 'required|integer|min:18',
            'contrasena' => 'required|string|min:6',
            'tipousuario' => 'required|in:usuario,administrador',
        ]);

        Usuario::create([
            'nombrecompleto' => [
                'nombre' => $request->nombre,
                'apellidoPaterno' => $request->apellidoPaterno,
                'apellidoMaterno' => $request->apellidoMaterno,
            ],
            'telefonos' => $request->telefonos,
            'correo' => $request->correo,
            'edad' => (int)$request->edad,
            'contrasena' => Hash::make($request->contrasena),
            'tipousuario' => $request->tipousuario,
        ]);

        return redirect()->route('usuarios.listar')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'required|string|max:255',
            'telefonos' => 'required|array',
            'telefonos.*' => 'string',
            'correo' => 'required|string|email|max:255|unique:usuarios,correo,' . $usuario->id,
            'edad' => 'required|integer|min:18',
            'contrasena' => 'required|string|min:6',
            'tipousuario' => 'required|in:usuario,administrador',
        ]);
    
        // Estructura para los datos actualizados
        $datosActualizados = [
            'nombrecompleto' => [
                'nombre' => $request->nombre,
                'apellidoPaterno' => $request->apellidoPaterno,
                'apellidoMaterno' => $request->apellidoMaterno,
            ],
            'telefonos' => $request->telefonos,
            'correo' => $request->correo,
            'edad' => $request->edad,
            'tipousuario' => $request->tipousuario,
        ];
    
        // Si se proporciona una nueva contraseña, la actualizamos
        if ($request->filled('contrasena')) {
            $datosActualizados['contrasena'] = Hash::make($request->contrasena);
        }
        $usuario->update($datosActualizados);

        return redirect()->route('usuarios.listar')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();
        return redirect()->route('usuarios.listar')->with('success', 'Usuario eliminado correctamente.');
    }
}
