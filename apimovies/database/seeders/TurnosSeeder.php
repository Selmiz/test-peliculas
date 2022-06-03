<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TurnosSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Turnos::factory(10)->create();
    }
}
