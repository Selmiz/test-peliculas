<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\TurnosController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [
    App\Http\Controllers\LoginController::class, 
    'login'
]);

Route::middleware('auth:sanctum')->Resource('peliculas', PeliculaController::class)->except('update');
//Se genera ruta POST para Update, en PUT no jala $request->all con formdata
Route::middleware('auth:sanctum')->post('peliculas/{pelicula}', [PeliculaController::class, 'update'])->name('peliculas.update');
Route::middleware('auth:sanctum')->get('peliculas/estado/{pelicula}', [PeliculaController::class, 'estado'])->name('peliculas.estado');

Route::middleware('auth:sanctum')->get('peliculas/asignaTurno/{pelicula}', [PeliculaController::class, 'asigna'])->name('peliculas.asigna');
Route::middleware('auth:sanctum')->get('peliculas/actualizaTurno/{pelicula}/{turno}', [PeliculaController::class, 'actualiza_turno'])->name('peliculas.actuaiza_turno');

Route::middleware('auth:sanctum')->Resource('turnos', TurnosController::class)->except('update');
//Se genera ruta POST para Update, en PUT no jala $request->all con formdata
Route::middleware('auth:sanctum')->post('turnos/{turno}', [TurnosController::class, 'update'])->name('turnos.update');
Route::middleware('auth:sanctum')->get('turnos/estado/{turno}', [TurnosController::class, 'estado'])->name('turnos.estado');