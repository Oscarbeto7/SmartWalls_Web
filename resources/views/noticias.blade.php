@extends('layouts.plantilla')

@section('title', 'SmartWalls - Noticias')

@section('content')
<section id="main-content">
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
        Noticias
    </nav>
    
    <div class="container">
        <h1>Noticias</h1>
        
        @if(isset($error))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <table>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Encabezado</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($noticias))
                    <tr>
                        <td colspan="3" class="text-center">No hay noticias disponibles</td>
                    </tr>
                @else
                    @foreach($noticias as $noticia)
                        <tr class="clickable-row" style="cursor: pointer;" onclick="window.location.href='{{ route('noticias.show', $noticia['id']) }}';">
                            <td>{{ $noticia['id'] }}</td>
                            <td>{{ $noticia['encabezado'] }}</td>
                            <td>{{ $noticia['fecha'] }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection