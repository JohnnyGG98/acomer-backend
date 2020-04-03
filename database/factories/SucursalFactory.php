<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sucursal;
use Faker\Generator as Faker;

$factory->define(Sucursal::class, function (Faker $faker) {
    return [
        'id_restaurante' => $faker->numberBetween(1, 500),
        'horario_atencion' => '{"Lunes" : "08h00 - 18h00"}',
        'numero' => $faker->numberBetween(1, 5),
        'direccion' => $faker->address,
        'latitud' => $faker->latitude,
        'longitud' => $faker->longitude
    ];
});
