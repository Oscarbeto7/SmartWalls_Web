<?php

namespace App\Models;

use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'usuario'; // Nombre de la colección

    protected $fillable = [
        'nombre_completo',
        'telefono',
        'correo',
        'edad',
        'tipo_usuario',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['contrasena'] = Hash::make($value);
    }
}