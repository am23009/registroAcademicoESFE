<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException; // Asegúrate de importar esta clase
use Illuminate\Support\Facades\Log; // Para loguear la excepción

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $query = Docente::query();

        if ($request->has('nombre')) {
            $query->whereRaw("nombre like '%$request->nombre%'");
        }

        $docentes = $query->orderBy('id', 'desc')->simplePaginate(10);
        return view('docentes.index', compact('docentes'));
    }

    public function show(Docente $docente)
    {
        return view('docentes.index', compact('docente'));
    }


    public function store(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:docente',
            'password' => 'required|min:6',
        ]);

        Docente::create($request->all());

        return redirect()->route('docentes.index')
                         ->with('success', 'Docente creado exitosamente.');
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:docente,email,'.$docente->id,
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only(['nombre', 'apellido', 'email']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $docente->update($data);

        return redirect()->route('docentes.index')
                         ->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy(Docente $docente)
    {
        try {

            $docente->delete();

            return redirect()->route('docentes.index')
                             ->with('success', 'Docente eliminado exitosamente.');
        } catch (QueryException $e) {

            if ($e->getCode() == '23000') { // Código de error para violación de restricción de clave foránea
                return redirect()->route('docentes.index')
                                 ->withError('No se puede eliminar el docente porque está asociado a uno o más grupos.');
            }

            // Para otros tipos de excepciones
            return redirect()->route('docentes.index')
                             ->withError('error', 'Ocurrió un error al intentar eliminar el docente.');

        }    
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::guard('docente')->attempt($credentials)){
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['InvalidCredentials'=> 'Las credenciales proporcionadas no coinciden con nuestros registros.']);
    }

    public function logout(){
        Auth::guard('docente')->logout();
        return redirect()->route('docentes.showLoginForm');
    }

    public function showLoginForm(){
        return view('docentes.login');
    }


}
