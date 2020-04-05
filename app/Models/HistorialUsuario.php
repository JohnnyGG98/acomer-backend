<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialUsuario extends Model
{
    use SoftDeletes;
    
    protected $table = 'historial_usuarios';

    protected $fillable = [
        'id_usuario',
        'accion',
        'plataforma'
    ];

    public function usuario(){
        return $this->hasOne('App\Models\Usuario', 'id', 'id_usuario');
    }

}
