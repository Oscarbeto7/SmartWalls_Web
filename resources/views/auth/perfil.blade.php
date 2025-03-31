@extends('layouts.plantilla')

@section('title', 'Perfil')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-info">
                <h1>{{ $usuario->nombrecompleto['nombre'] }} </h1>
                <div class="user-details">
                    <span><i class="fas fa-envelope"></i> {{ $usuario->correo }}</span>
                    <span><i class="fas fa-calendar"></i> Miembro desde {{ $usuario->created_at->format('Y') }}</span>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <div class="info-section">
                <h2><i class="fas fa-user"></i> Información Personal</h2>
                <ul class="info-list">
                    <li>
                        <span>Nombre completo</span>
                        <span>{{ $usuario->nombrecompleto['nombre'] }} {{ $usuario->nombrecompleto['apellidoPaterno'] }} {{ $usuario->nombrecompleto['apellidoMaterno'] }}</span>
                    </li>
                    <li>
                        <span>Teléfono</span>
                        <span>{{ implode(', ', $usuario->telefonos) }}</span>
                    </li>
                </ul>
            </div>

            <div class="info-section">
                <h2><i class="fas fa-home"></i> Mis Casas</h2>
                @if ($casas->isEmpty())
                    <p>No tienes casas registradas.</p>
                @else
                    <ul class="info-list">
                        @foreach ($casas as $casa)
                            <li>
                                <span>Nombre</span>
                                <span>{{ $casa['nombre_casa'] }}</span>
                            </li>
                            <li>
                                <span>Dirección</span>
                                <span>{{ $casa['domicilio'] ?? 'No disponible' }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Botón para editar perfil -->
            <div>
                <a href="{{ route('perfil.editar') }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar Información
                </a>
                <br>
                <br>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Graficas
                </a>
            </div>
            

        </div>
    </div>
</div>



@endsection