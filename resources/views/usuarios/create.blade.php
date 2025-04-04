@extends('layouts.plantilla')

@section('title', 'SmartWalls - Agregar Usuario')

@section('content')
<section id="main-content">
    <div class="container">
        <h1>Agregar Usuario</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
        <input type="text" name="apellidoPaterno" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
        <input type="text" name="apellidoMaterno" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="correo" class="form-label">Correo Electrónico</label>
        <input type="email" name="correo" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="edad" class="form-label">Edad</label>
        <input type="number" name="edad" class="form-control" required min="18">
    </div>
    
    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" name="contrasena" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="telefonos" class="form-label">Telefono</label>
        <input type="text" name="telefonos[]" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="tipousuario" class="form-label">Tipo de Usuario</label>
        <select name="tipousuario" class="form-control" required>
            <option value="usuario">Usuario</option>
            <option value="administrador">Administrador</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Registrar</button>
    <a href="{{ route('usuarios.listar') }}" class="btn btn-secondary">Cancelar</a>
</form>
    </div>
</section>
@endsection
