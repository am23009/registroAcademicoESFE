<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;

Route::group(['prefix'=>'asistencia'], function(){
    Route::get('/', [AsistenciaController::class, 'index'])->name('asistencia.index');
    Route::post('/', [AsistenciaController::class, 'store'])->name('asistencia.store');
    // Route::put('/{docente}', [AsistenciaController::class, 'update'])->name('docentes.update');
    // Route::delete('/{docente}', [AsistenciaController::class, 'destroy'])->name('docentes.destroy');
});