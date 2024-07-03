<?php
namespace App\Http\Controllers;

use App\Models\DocenteGrupo;
use Illuminate\Http\Request;
use App\Models\Grupo; 
use App\Models\Docente;

class DocenteGrupoController extends Controller
{
    public function index()
    { 
        $docenteGrupos = $docenteGrupos = DocenteGrupo::with('docente', 'grupo')->simplePaginate(10);

        $grupos = Grupo::all(); 
        $docentes = Docente::all();

        return view('docente_grupos.index', compact('docenteGrupos', 'grupos', 'docentes'));
    }

    public function store(Request $request)
    {
        try {

            // dd($request->all());

            $request->validate([
                'docente_id' => 'required',
                'group_id' => 'required',
            ]); 
    
            DocenteGrupo::create($request->all());
    
            return redirect()->route('docente_grupos.index')
                             ->with('success', 'Docente asignado a grupo exitosamente.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('docente_grupos.index')
                             ->with('error', 'Error al asignar docente a grupo.');
            
        }

       
    }

    public function update(Request $request, $id)
    {   
        // Encuentra el modelo por su id
        $docenteGrupo = DocenteGrupo::find($id);

        if (!$docenteGrupo) {
            // Manejo del caso donde no se encuentra el modelo
            return redirect()->route('docente_grupos.index')
                            ->with('error', 'El registro no pudo ser encontrado.');
        }

        // Valida y actualiza los campos específicos
        $request->validate([
            'docente_id' => 'required',
            'group_id' => 'required',
        ]);

        $docenteGrupo->docente_id = $request->docente_id;
        $docenteGrupo->group_id = $request->group_id;

        // Guarda los cambios en la base de datos
        $docenteGrupo->save();

        return redirect()->route('docente_grupos.index')
                        ->with('success', 'Docente asignado a grupo actualizado exitosamente.');
    }

    public function destroy(DocenteGrupo $docenteGrupo)
    {
        $docenteGrupo->delete();

        return redirect()->route('docente_grupos.index')
                         ->with('success', 'Docente asignado a grupo eliminado exitosamente.');
    }
}
