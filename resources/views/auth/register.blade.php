@extends('layouts.plantilla')

@section('title', 'Registro - SmartWalls')

@section('content')
<section id="background-image" style="position: relative; text-align: center;">
    <img src="{{ asset('img/ImagenCasa2.jpg') }}" alt="Remodelaciones" style="width: 100%; height: auto;">
    <section id="register" style="padding: 20px;">
    <div class="register-container">
        <h1>Registro de Usuario</h1>

        <!-- Mostrar el mensaje de error arriba del formulario -->
        <div id="error-message" style="color: red; font-size: 16px; margin-bottom: 20px;">
            @if(session('error'))
                {{ session('error') }}
            @endif
        </div>

        <form action="{{ url('register') }}" method="POST">
            @csrf

            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                @if ($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
            </div>

            <div>
                <label for="apellidoPaterno">Apellido Paterno:</label>
                <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{ old('apellidoPaterno') }}" required>
                @if ($errors->has('apellidoPaterno'))
                    <span class="text-danger">{{ $errors->first('apellidoPaterno') }}</span>
                @endif
            </div>

            <div>
                <label for="apellidoMaterno">Apellido Materno:</label>
                <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{ old('apellidoMaterno') }}" required>
                @if ($errors->has('apellidoMaterno'))
                    <span class="text-danger">{{ $errors->first('apellidoMaterno') }}</span>
                @endif
            </div>

            <div>
                <label for="telefonos">Teléfonos:</label>
                <input type="text" name="telefonos[]" id="telefonos" value="{{ old('telefonos.0') }}" required>
                @if ($errors->has('telefonos'))
                    <span class="text-danger">{{ $errors->first('telefonos') }}</span>
                @endif
            </div>

            <div>
                <label for="correo">Correo Electrónico:</label>
                <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required>
                @if ($errors->has('correo'))
                    <span class="text-danger">{{ $errors->first('correo') }}</span>
                @endif
            </div>

            <div>
                <label for="edad">Edad:</label>
                <input type="number" name="edad" id="edad" value="{{ old('edad') }}" required>
                @if ($errors->has('edad'))
                    <span class="text-danger">{{ $errors->first('edad') }}</span>
                @endif
            </div>

            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" required>
                @if ($errors->has('contrasena'))
                    <span class="text-danger">{{ $errors->first('contrasena') }}</span>
                @endif
            </div>

            <button type="submit">Registrar</button>
        </form>

        <p>¿Ya tienes cuenta? <a href="{{ url('login') }}">Inicia sesión aquí</a></p>
    </div>
    </section>
</section>
@endsection