<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteGrupoController as EstudianteGrupo;

Route::group(['prefix'=>'estudiante_grupos', 'middleware'=>'auth_docentes'], function(){
    Route::get('/', [EstudianteGrupo::class, 'index'])->name('estudiante_grupos.index');
    Route::post('/', [EstudianteGrupo::class, 'store'])->name('estudiante_grupos.store');
    Route::put('/{estudiante_grupos}', [EstudianteGrupo::class, 'update'])->name('estudiante_grupos.update');
    Route::delete('/{estudiante_grupos}', [EstudianteGrupo::class, 'destroy'])->name('estudiante_grupos.destroy');
});