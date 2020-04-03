<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialUsuario extends Model
{
    protected $table = 'historial_usuarios';

    protected $fillable = [
        'id_usuario',
        'accion',
        'plataforma'
    ];
}
