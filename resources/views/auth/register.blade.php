@extends('layouts.plantilla')

@section('title', 'Registro - SmartWalls')

@section('content')
<section id="background-image" style="position: relative; text-align: center;">
    <img src="{{ asset('img/ImagenCasa2.jpg') }}" alt="Remodelaciones" style="width: 100%; height: auto;">
    <section id="register" style="padding: 20px;">
    <div class="register-container">
    <h1>Registro de Usuario</h1>

    <form action="{{ url('register') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div>
            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" name="apellidoPaterno" id="apellidoPaterno" required>
        </div>

        <div>
            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" name="apellidoMaterno" id="apellidoMaterno" required>
        </div>

        <div>
            <label for="telefonos">Teléfonos:</label>
            <input type="text" name="telefonos[]" id="telefonos" required>
        </div>

        <div>
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" id="correo" required>
        </div>

        <div>
            <label for="edad">Edad:</label>
            <input type="number" name="edad" id="edad" required>
        </div>

        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" required>
        </div>

        <button type="submit">Registrar</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{ url('login') }}">Inicia sesión aquí</a></p>
    </div>
    </section>
</section>
@endsection
