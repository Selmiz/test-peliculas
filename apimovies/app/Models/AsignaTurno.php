<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignaTurno extends Model
{
    /* use HasFactory; */
    protected $table = 'asigna_turno';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pelicula',
        'id_turno',
    ];
}
