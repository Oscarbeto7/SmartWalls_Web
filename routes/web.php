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

Route::get('login', function () {
    return view('login'); // Aquí redirige a tu vista login.blade.php
})->name('login'); // Se asegura de que esta sea la ruta correcta para login

Route::post('login', [AuthController::class, 'login'])->name('login.submit'); // Acción POST para el login

// Ruta para la página de inicio
Route::get('/', function () {
    return view('home');
})->name('home'); // Página de inicio después de login

// Ruta para la página de registro
Route::get('register', function () {
    return view('auth.register'); // Redirige a la vista de registro
})->name('register');

// Si quieres redirigir al usuario a una página de inicio después de iniciar sesión, puedes usar esta ruta
Route::post('login', [AuthController::class, 'login'])->middleware('auth')->name('login.submit');

// Rutas de ejemplo que puedes eliminar si no las necesitas
Route::get('iniciosesion', function(){
    return "Inicia sesión:";
});

Route::get('iniciosesion/{registro}', function($registro){
    return "Regístrate para el curso: $registro";
});