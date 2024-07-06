<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\EstudianteGrupo;
use App\Models\Grupo;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Asistencia::all();
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();

        return view('asistencia.index', compact('asistencias', 'estudiantes', 'grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pin' => 'required|string',
        ]);
    
        $estudiante = Estudiante::where('pin', $request->pin)->first();

        if (!$estudiante) {
            return redirect()->back()->withError('No se encontró ningún estudiante con el PIN proporcionado.');
        }

        $estudianteGrupo = EstudianteGrupo::where('estudiante_id', $estudiante->id)->first();
        
        $grupo_id = $estudianteGrupo->group_id;
        
        $asistencia = new Asistencia();
    
        $asistencia->estudiante_id = $estudiante->id;
        $asistencia->grupo_id = $grupo_id;
        $asistencia->fecha = now()->toDateString();
        $asistencia->hora_entrada = now()->toTimeString();
    
        $asistencia->save();
    
        return redirect()->route('asistencia.index')->with('success', 'Asistencia registrada exitosamente.');
    }

    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
