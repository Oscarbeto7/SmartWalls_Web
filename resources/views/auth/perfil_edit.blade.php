@extends('layouts.plantilla')

@section('title', 'Editar Perfil')

@section('content')
<section id="background-image" style="position: relative; text-align: center;">
    <img src="{{ asset('img/ImagenCasa2.jpg') }}" alt="Remodelaciones" style="width: 100%; height: auto;">
    <section id="register" style="padding: 20px;">
        <div class="register-container">
            <h1>Editar Perfil</h1>

            <form action="{{ route('perfil.actualizar') }}" method="POST">
                @csrf

                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombrecompleto['nombre']) }}" required>
                </div>

                <div>
                    <label for="apellidoPaterno">Apellido Paterno:</label>
                    <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{ old('apellidoPaterno', $usuario->nombrecompleto['apellidoPaterno']) }}" required>
                </div>

                <div>
                    <label for="apellidoMaterno">Apellido Materno:</label>
                    <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{ old('apellidoMaterno', $usuario->nombrecompleto['apellidoMaterno']) }}" required>
                </div>

                <div>
                    <label for="telefonos">Teléfonos:</label>
                    <input type="text" name="telefonos[]" id="telefonos" value="{{ old('telefonos', implode(',', $usuario->telefonos)) }}" required>
                </div>

                <div>
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" name="correo" id="correo" value="{{ old('correo', $usuario->correo) }}" required>
                </div>

                <div>
                    <label for="edad">Edad:</label>
                    <input type="number" name="edad" id="edad" value="{{ old('edad', $usuario->edad) }}" required>
                </div>

                

                <button type="submit">Actualizar</button>
            </form>
        </div>
    </section>
</section>
@endsection