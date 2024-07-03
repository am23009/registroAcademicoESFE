<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocenteController;

Route::group(['prefix'=>'docentes', 'middleware'=>'auth_docentes'], function(){
    Route::get('/', [DocenteController::class, 'index'])->name('docentes.index');
    Route::post('/', [DocenteController::class, 'store'])->name('docentes.store');
    Route::put('/{docente}', [DocenteController::class, 'update'])->name('docentes.update');
    Route::delete('/{docente}', [DocenteController::class, 'destroy'])->name('docentes.destroy');
});

Route::get('/docentes/login', [DocenteController::class, 'showLoginForm'])->name('docentes.showLoginForm');
Route::post('/docentes/login', [DocenteController::class, 'login'])->name('docentes.login');
Route::post('/docentes/logout', [DocenteController::class, 'logout'])->name('docentes.logout');