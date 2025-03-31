<?php 
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable; // Importar la interfaz
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; // Importar el trait

class Prueba extends Eloquent implements Authenticatable // Implementar la interfaz
{
    use AuthenticatableTrait; // Agregar el trait para autenticación

    protected $connection = 'mongodb';

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombrecompleto', 'telefonos', 'correo', 'edad', 'contrasena', 'tipousuario'
    ];

    protected $casts = [
        'nombrecompleto' => 'array', // Asegura que sea tratado como un array
        'telefonos' => 'array', // Asegura que telefonos sea un array
    ];

    // Laravel espera que el campo de contraseña se llame "password"
    public function getAuthPassword()
    {
        return $this->contrasena; // Retorna la contraseña correcta
    }
}
