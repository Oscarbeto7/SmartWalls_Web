<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NoticiaController extends Controller
{
    public function index()
    {
        // Leer el archivo JSON desde la carpeta data
        $jsonPath = app_path('data/noticias.json');
        
        if (!File::exists($jsonPath)) {
            return view('noticias', ['noticias' => [], 'error' => 'Archivo JSON no encontrado']);
        }
        
        // Leer el contenido del archivo
        $jsonContent = File::get($jsonPath);
        $data = json_decode($jsonContent, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return view('noticias', ['noticias' => [], 'error' => 'Error al decodificar JSON: ' . json_last_error_msg()]);
        }
        
        // Extraer el array de noticias
        $noticias = $data['noticias'] ?? [];
        
        // Agregar un índice como ID para cada noticia
        foreach ($noticias as $index => &$noticia) {
            $noticia['id'] = $index + 1;
        }
        
        return view('noticias', compact('noticias'));
    }
    
    public function show($id)
    {
        // Leer el archivo JSON
        $jsonPath = base_path('app/data/noticias.json');
        $jsonContent = File::get($jsonPath);
        $data = json_decode($jsonContent, true);
        
        // Extraer las noticias
        $noticias = $data['noticias'] ?? [];
        
        // Restar 1 porque los arrays comienzan en 0
        $index = $id - 1;
        
        // Verificar si existe la noticia
        if (isset($noticias[$index])) {
            $noticia = $noticias[$index];
            return view('noticias.show', compact('noticia'));
        }
        
        return redirect()->route('noticias')->with('error', 'Noticia no encontrada');
    }
}