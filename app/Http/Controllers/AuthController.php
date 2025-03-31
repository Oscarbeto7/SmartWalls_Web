<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Aquí se importa Hash
use Illuminate\Support\Facades\Validator; // Aquí se importa Validator
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'required|string|max:255',
            'telefonos' => 'required|array',
            'telefonos.*' => 'string',
            'correo' => 'required|string|email|max:255|unique:users,correo',
            'edad' => 'required|integer|min:18',
            'contrasena' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el registro con la estructura deseada
        $prueba = Prueba::create([
            'nombrecompleto' => json_decode(json_encode([
                'nombre' => $request->nombre,
                'apellidoPaterno' => $request->apellidoPaterno,
                'apellidoMaterno' => $request->apellidoMaterno,
            ])),
            'telefonos' => $request->telefonos,
            'correo' => $request->correo,
            'edad' => $request->edad,
            'contrasena' => Hash::make($request->contrasena),
            'tipousuario' => 'usuario',
        ]);

        // Redirigir al login después de un registro exitoso
        return redirect()->route('login')->with('success', 'Registro exitoso');
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'correo' => 'required|string|email|max:255',
            'contrasena' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Buscar el usuario por correo
        $usuario = Prueba::where('correo', $request->correo)->first();

        if (!$usuario) {
            return response()->json(['error' => 'Correo no encontrado'], 404);
        }

        // Verificar si la contraseña es correcta
        if (Hash::check($request->contrasena, $usuario->contrasena)) {
            // Guardar los datos en sesión
            session([
                'usuario' => [
                    'nombre' => $usuario->nombrecompleto['nombre'],
                    'apellidoPaterno' => $usuario->nombrecompleto['apellidoPaterno'],
                    'apellidoMaterno' => $usuario->nombrecompleto['apellidoMaterno'],
                    'telefonos' => $usuario->telefonos,
                    'correo' => $usuario->correo,
                    'edad' => $usuario->edad,
                    'tipousuario' => $usuario->tipousuario,
                ]
            ]);

            return redirect('/'); // Redirigir a la vista de bienvenida
        }

        return response()->json(['error' => 'Contraseña incorrecta'], 401);
    }

    public function showRegister()
    {
        return view('auth.register'); // Vista de registro
    }

    public function showLogin()
    {
        return view('auth.login'); // Vista de login
    }

    public function logout(Request $request)
    {
        session()->forget('usuario'); // Eliminar datos de sesión
        return redirect('/'); // Redirigir al login
    }

    public function mostrarPerfil()
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu perfil.');
        }
    
        $correo = session('usuario')['correo'];
    
        // Obtener los datos del usuario desde la base de datos
        $usuario = Prueba::where('correo', $correo)->first();
    
        if (!$usuario) {
            return redirect()->route('login')->with('error', 'No se encontró la información del usuario.');
        }
    
        // Obtener las casas donde el usuario es el propietario
        $casas = DB::connection('mongodb')->table('casas')->where('propietario', $correo)->get();

    
        return view('auth.perfil', compact('usuario', 'casas'));
    }

    public function editarPerfil()
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para editar tu perfil.');
        }

        $correo = session('usuario')['correo'];
        $usuario = Prueba::where('correo', $correo)->first();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Usuario no encontrado.');
        }

        return view('auth.perfil_edit', compact('usuario'));
    }

    public function actualizarPerfil(Request $request)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para actualizar tu perfil.');
        }

        $correo = session('usuario')['correo'];
        $usuario = Prueba::where('correo', $correo)->first();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Usuario no encontrado.');
        }

        // Reglas de validación para los datos del perfil
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'required|string|max:255',
            'telefonos' => 'required|array',
            'telefonos.*' => 'string',
            'correo' => 'required|string|email|max:255',
            'edad' => 'required|integer|min:18',
        ];

        // Validar si se envió una nueva contraseña
        if ($request->filled('contrasena_nueva')) {
            $rules['contrasena_nueva'] = 'required|string|min:6|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('perfil.editar')
                ->withErrors($validator)
                ->withInput();
        }

        // Actualizar la contraseña si se proporcionó
        $datosActualizados = [
            'nombrecompleto' => [
                'nombre' => $request->nombre,
                'apellidoPaterno' => $request->apellidoPaterno,
                'apellidoMaterno' => $request->apellidoMaterno,
            ],
            'telefonos' => $request->telefonos,
            'correo' => $request->correo,
            'edad' => $request->edad,
        ];

        // Si se proporcionó una nueva contraseña, la actualizamos
        if ($request->filled('contrasena_nueva')) {
            $datosActualizados['contrasena'] = Hash::make($request->contrasena_nueva);
        }

        // Actualizar los datos del perfil
        $usuario->update($datosActualizados);

        // Actualizar la sesión del usuario
        session()->put('usuario', [
            'nombre' => $request->nombre,
            'apellidoPaterno' => $request->apellidoPaterno,
            'apellidoMaterno' => $request->apellidoMaterno,
            'telefonos' => $request->telefonos,
            'correo' => $request->correo,
            'edad' => $request->edad,
            'tipousuario' => $usuario->tipousuario,
        ]);

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
