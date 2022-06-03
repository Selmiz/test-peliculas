<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class PeliculasSeeder extends Seeder
{
 
    public function run()
    {
        \App\Models\Peliculas::factory(10)->create();
    }
}
