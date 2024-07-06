<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DocenteGrupoController;
use App\Http\Controllers\EstudianteController;


Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/', function () {
    return view('home');
});

require __DIR__.'/asistencia_routes.php';
require __DIR__.'/docente_routes.php';
require __DIR__.'/grupo_routes.php';
require __DIR__.'/estudiante_routes.php';
require __DIR__.'/docente_grupos_routes.php';
require __DIR__.'/estudiante_grupos_routes.php';
    