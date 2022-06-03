<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AsignaTurnoFactory extends Factory
{
   
    public function definition()
    {
        return [
            'id_pelicula' => rand(1,9),
            'id_turno' => rand(1,9)         
        ];
    }
}
