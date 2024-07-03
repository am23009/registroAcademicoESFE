<?php

namespace App\Http\Controllers;

use App\Models\EstudianteGrupo;
use Illuminate\Http\Request;

class EstudianteGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudianteGrupo = EstudianteGrupo::all();
        return view('estudiante_grupos.index', compact('estudianteGrupo'));
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    public function destroy(Estudiante $estudiante)
    {
        //
    }

}