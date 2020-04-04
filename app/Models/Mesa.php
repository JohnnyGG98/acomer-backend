<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'mesas';

    protected $fillable = [
        'numero',
        'capacidad',
        'descripcion'
    ];

    public function restaurante(){
        return $this->belongsTo('App\Models\Restaurante', 'id_restaurante');
    }
    
    public function reservas()
    {
        return $this->hasMany('App\Models\Reserva', 'id_reserva');
    }

    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido', 'id_mesa');
    }
}
