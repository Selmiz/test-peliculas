<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class TurnosFactory extends Factory
{

    public function definition()
    {
        return [
            'turno' => Date('H:i:s'),
            'estado' => true         
        ];
    }
}
