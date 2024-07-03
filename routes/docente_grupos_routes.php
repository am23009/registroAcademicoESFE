<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocenteGrupoController;

Route::group(['prefix'=>'docente_grupos', 'middleware'=>'auth_docentes'], function(){
    Route::get('/', [DocenteGrupoController::class, 'index'])->name('docente_grupos.index');
    Route::post('/', [DocenteGrupoController::class, 'store'])->name('docente_grupos.store');
    Route::put('/{docente_grupos}', [DocenteGrupoController::class, 'update'])->name('docente_grupos.update');
    Route::delete('/{docente_grupos}', [DocenteGrupoController::class, 'destroy'])->name('docente_grupos.destroy');
});