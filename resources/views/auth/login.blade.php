@extends('layouts.plantilla')

@section('title', 'SmartWalls')

@section('content')

<section id="background-image" style="position: relative; text-align: center;">
    <img src="{{ asset('img/ImagenCasa2.jpg') }}" alt="Remodelaciones" style="width: 100%; height: auto;">

    <!-- Contenedor del Login -->
    <section id="register" style="padding: 20px;">
        <div class="register-container" >
            
            <h1>Inicio de Sesión</h1>

            <form action="{{ url('login') }}" method="POST">
                @csrf
              <label for="correo">
                        <p>Correo electrónico</p>
                        <input type="email" placeholder="ejemplo@gmail.com" id="email"  name="correo" >
                    </label>
                    <label for="contrasena">
                        <p>Contraseña</p>
                        <input type="password" placeholder="Contraseña" id="password" name="contrasena"">
                    </label>

                <button type="submit" 
                        >
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