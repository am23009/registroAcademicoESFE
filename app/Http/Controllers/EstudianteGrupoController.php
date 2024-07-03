<?php

namespace App\Http\Controllers;

use App\Models\EstudianteGrupo;
use Illuminate\Http\Request;
use App\Models\Estudiante;  
use App\Models\Grupo;  

class EstudianteGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudianteGrupos = EstudianteGrupo::all();

        $grupos = Grupo::all(); 
        $estudiantes = Estudiante::all();

       
        return view('estudiante_grupos.index', compact('estudianteGrupos', 'grupos', 'estudiantes'));
    }

    public function store(Request $request)
    {
        try {

            // dd($request->all());

            $request->validate([
                'estudiante_id' => 'required',
                'group_id' => 'required',
            ]); 
    
            EstudianteGrupo::create($request->all());
    
            return redirect()->route('estudiante_grupos.index')
                             ->with('success', 'Estudiante asignado a grupo exitosamente.');
        } catch (\Throwable $th) {
            dd($th);    
            return redirect()->route('estudiante_grupos.index')
                             ->with('error', 'Error al asignar estudiante a grupo.');
            
        }
    }

    public function update(Request $request, $id)
    {
        $estudianteGrupo = EstudianteGrupo::find($id);

        if (!$estudianteGrupo) {
            return redirect()->route('docente_grupos.index')
                            ->with('error', 'El registro no pudo ser encontrado.');
        }

        $request->validate([
            'estudiante_id' => 'required',
            'group_id' => 'required',
        ]);

        $estudianteGrupo->estudiante_id = $request->estudiante_id;
        $estudianteGrupo->group_id = $request->group_id;

        $estudianteGrupo->save();

        return redirect()->route('estudiante_grupos.index')
                        ->with('success', 'Docente asignado a grupo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        
        $_estudianteGrupo = EstudianteGrupo::find($id);

        if (!$_estudianteGrupo) {
            return redirect()->route('estudiante_grupos.index')
                            ->with('error', 'El registro no pudo ser encontrado.');
        }

        $_estudianteGrupo->delete();

        return redirect()->route('estudiante_grupos.index')
                         ->with('success', 'Estudiante asignado a grupo eliminado exitosamente.');
    
    }

}