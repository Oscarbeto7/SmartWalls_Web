@extends('layouts.plantilla')

@section('title', 'SmartWalls')

@section('content')

<section id="background-image" style="position: relative; text-align: center;">
    <img src="{{ asset('img/ImagenCasa2.jpg') }}" alt="Remodelaciones" style="width: 100%; height: auto;">

    <!-- Contenedor del Login -->
    <section id="register" style="padding: 20px;">
        <div class="register-container">
            
            <h1>Inicio de Sesión</h1>

            <!-- Mostrar el mensaje de error arriba del formulario -->
            <div id="error-message" style="color: red; font-size: 16px; margin-bottom: 20px;">
                @if(session('error'))
                    {{ session('error') }}
                @endif
            </div>

            <!-- Formulario de Login -->
            <form action="{{ url('login') }}" method="POST">
                @csrf

                <!-- Campo de Correo -->
                <label for="correo">
                    <p>Correo electrónico</p>
                    <input type="email" placeholder="ejemplo@gmail.com" id="email" name="correo" value="{{ old('correo') }}">
                    @if ($errors->has('correo'))
                        <span class="text-danger">{{ $errors->first('correo') }}</span>
                    @endif
                </label>

                <!-- Campo de Contraseña -->
                <label for="contrasena">
                    <p>Contraseña</p>
                    <input type="password" placeholder="Contraseña" id="password" name="contrasena">
                    @if ($errors->has('contrasena'))
                        <span class="text-danger">{{ $errors->first('contrasena') }}</span>
                    @endif
                </label>

                <button type="submit">
                    Iniciar sesión
                </button>
            </form>

            <p style="margin-top: 15px;">¿No tienes cuenta? 
                <a href="{{ url('register') }}" style="color: #007BFF;">Regístrate aquí</a>
            </p>
        </div>
    </section>
</section>

@endsection