<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

class PeliculasFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'fecha_publicacion' => Date('d/m/Y'),
            'estado' => true,
            'imagen' => null            
        ];
    }
}
