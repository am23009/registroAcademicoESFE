<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

Route::group(['prefix'=>'estudiantes'], function(){
    Route::get('/', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::post('/', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::put('/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::delete('/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');
});

// Route::get('/docentes/login', [EstudianteController::class, 'showLoginForm'])->name('estudiantes.showLoginForm');
// Route::post('/docentes/login', [EstudianteController::class, 'login'])->name('docentes.login');
// Route::post('/docentes/logout', [EstudianteController::class, 'logout'])->name('docentes.logout');