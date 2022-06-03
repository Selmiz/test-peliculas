<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{

    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->date('fecha_publicacion');
            $table->boolean('estado')->default(true);
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}
