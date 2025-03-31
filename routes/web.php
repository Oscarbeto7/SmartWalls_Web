<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta para la página de inicio (home) - GET
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/noticias', [App\Http\Controllers\NoticiaController::class, 'index'])->name('noticias');


// Rutas de prueba para MongoDB (esto puedes eliminarlas si no las necesitas)
Route::get('/test-db', function () {
    try {
        $connection = DB::connection('mongodb');
        $databases = $connection->getMongoClient()->listDatabases();
        return response()->json($databases);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});

Route::get('/test-insert', function () {
    DB::connection('mongodb')->table('prueba')->insert([
        'nombre' => 'Jesús',
        'edad' => 25
    ]);
    return response()->json(['mensaje' => 'Documento insertado']);
});

// Rutas de registro (GET para mostrar formulario, POST para registrar)
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Rutas de login (GET para mostrar formulario, POST para iniciar sesión)
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('/bienvenida', function () {
    if (!session()->has('usuario')) {
        return redirect('/'); // Si no hay sesión, redirige al login
    }
    return view('bienvenida');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/noticias', [App\Http\Controllers\NoticiaController::class, 'index'])->name('noticias');
Route::get('/noticias/{id}', [App\Http\Controllers\NoticiaController::class, 'show'])->name('noticias.show');
Route::get('/perfil', [AuthController::class, 'mostrarPerfil'])->name('perfil');

Route::get('/perfil/editar', [AuthController::class, 'editarPerfil'])->name('perfil.editar');
Route::post('/perfil/editar', [AuthController::class, 'actualizarPerfil'])->name('perfil.actualizar');

