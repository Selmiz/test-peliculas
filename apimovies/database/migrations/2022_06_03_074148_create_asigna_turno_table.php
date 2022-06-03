<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignaTurnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asigna_turno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelicula');
            $table->unsignedBigInteger('id_turno');
            $table->timestamps();

            $table->foreign('id_pelicula')->references('id')->on('peliculas');
            $table->foreign('id_turno')->references('id')->on('turnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asigna_turno');
    }
}
