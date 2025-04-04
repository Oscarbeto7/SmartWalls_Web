<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Usuario extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait;
    
    protected $connection = 'mongodb';
    protected $collection = 'usuarios';

    protected $fillable = [
        'nombrecompleto', 'telefonos', 'correo', 'edad', 'contrasena', 'tipousuario'
    ];
    
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
