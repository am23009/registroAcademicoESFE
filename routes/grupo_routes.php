<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;

Route::group(['prefix'=>'grupos', 'middleware'=>'auth_docentes'], function(){
    Route::get('/', [GrupoController::class, 'index'])->name('grupos.index');
    Route::post('/', [GrupoController::class, 'store'])->name('grupos.store');
    Route::put('/{grupo}', [GrupoController::class, 'update'])->name('grupos.update');
    Route::delete('/{grupo}', [GrupoController::class, 'destroy'])->name('grupos.destroy');
});