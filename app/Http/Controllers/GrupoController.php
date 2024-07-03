<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Grupo::query();

        if ($request->has('nombre')) {
            $query->whereRaw("nombre like '%$request->nombre%'");
            // ('nombre','like', '%' . $request->nombre.'%')
        }

        $grupos = $query->orderBy('id', 'desc')->simplePaginate(10);
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
        ]);

        Grupo::create($request->all());

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo creado exitosamente.');
    }
    
    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo actualizado exitosamente.');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo eliminado exitosamente.');
    }
}
