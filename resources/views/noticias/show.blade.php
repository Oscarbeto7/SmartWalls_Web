@extends('layouts.plantilla')

@section('title', 'SmartWalls - Detalle de Noticia')

@section('content')
<section id="main-content">
    <div class="container my-5">
        <div class="my-4 text-center">
            <h1>{{ $noticia['encabezado'] }}</h1>
            <p class="texto">{{ $noticia['fecha'] }} - Autor: {{ $noticia['autor'] }}</p>
        </div>
        
        <div class="card noticia-container">
            <div class="card-body">
                <br>
                <h5 class="card-title">{{ $noticia['resumen'] }}</h5>
                <br>
                <p class="card-text texto">{{ $noticia['contenido'] }}</p>
            
                <div class="mt-4 imagen text-center">
                    @if(!empty($noticia['imagen']))
                        <img src="{{ asset($noticia['imagen']) }}" class="img-fluid rounded shadow" alt="Imagen de la noticia">
                    @else
                        <p class="text-muted">No hay imagen disponible.</p>
                    @endif
                </div>
            </div>
            
            <div class="card-footer text-center">
                <a href="{{ route('noticias') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Volver a Noticias
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
