<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AsignaTurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AsignaTurno::factory(10)->create();
    }
}
