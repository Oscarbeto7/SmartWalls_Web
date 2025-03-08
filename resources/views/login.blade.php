@extends('layouts.plantilla')

@section('title', 'SmartWalls')

@section('content')
<section id="background-image" style="position: relative; text-align: center;">
    <img src="../img/ImagenCasa2.jpg" alt="Remodelaciones" style="width: 100%; height: auto;">

    <!-- Contenedor del Login -->
    <section id="register">
        <div class="register-container">
            <!-- Formulario de Login -->
            <form id="login-form" method="POST" action="{{ route('home') }}">
                @csrf
                <h1>Bienvenido</h1>
                
                <!-- Campo de correo electrónico -->
                <label for="correo">
                    <p>Correo electrónico</p>
                    <input type="email" placeholder="ejemplo@gmail.com" id="correo" name="correo" value="{{ old('correo') }}" required autofocus>
                </label>

                <!-- Campo de contraseña -->
                <label for="contrasena">
                    <p>Contraseña</p>
                    <input type="password" placeholder="Contraseña" id="contrasena" name="contrasena" required>
                </label>

                <!-- Mostrar errores -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit"><span>Iniciar sesión</span></button>
            </form>
        </div>

        <!-- Enlace para el registro de usuario -->
        <div>
            <a href="{{ route('register') }}">¿No tienes una cuenta? Regístrate aquí.</a>
        </div>
    </section>
</section>
@endsection
