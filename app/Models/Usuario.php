<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Usuario extends MongoModel implements Authenticatable
{
    use AuthenticatableTrait;

    protected $connection = 'mongodb';
    protected $collection = 'usuarios';

    protected $fillable = [
        'nombre_completo',
        'telefono',
        'correo',
        'edad',
        'tipo_usuario',
        'contrasena'
    ];

    // Ocultar campos sensibles
    protected $hidden = [
        'contrasena'
    ];

    // Definir el campo de contraseña para la autenticación
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}