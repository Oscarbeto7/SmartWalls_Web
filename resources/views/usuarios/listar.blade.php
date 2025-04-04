@extends('layouts.plantilla')

@section('title', 'SmartWalls - Usuarios')

@section('content')
<div class="container">
    <h2>Lista de Usuarios</h2>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Añadir Usuario</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nombrecompleto['nombre'] }} {{ $usuario->nombrecompleto['apellidoPaterno'] }} {{ $usuario->nombrecompleto['apellidoMaterno'] }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>{{ $usuario->edad }}</td>
                <td>{{ implode(', ', $usuario->telefonos) }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->_id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('usuarios.eliminar', $usuario->_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
