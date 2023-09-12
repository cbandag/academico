<?php

namespace App\Http\Controllers;
use App\Models\Facultad;
use App\Models\Programa;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProgramasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programas = Programa::all();
        $facultades = Facultad::all();
        return view('programas.index', compact('programas', 'facultades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facultades = Facultad::all();
        return view('programas.create', compact('facultades'));   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Request()->validate([
            'nombre'=>'required|string|unique:programas,nombre|max:100',
            'facultad_id'=>'required|numeric|max:1000',

        ],[
            'nombre.required'=>'El nombre es requerido.',
            'facultad_id.required'=>'La facultad es requerida.'
        ]);

        DB::transaction(function() use ($data){
            Programa::create([
                'nombre' => $data['nombre'],
                'facultad_id' => $data['facultad_id'],
            ]);

        });

        return redirect()->route('programas.index')->with('message','Programa creado con éxito!!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $programa = Programa::findOrFail($id);
        $facultades = Facultad::all();
        return view('programas.show', compact('programa', 'facultades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programa = Programa::findOrFail($id);
        $facultades = Facultad::all();
        return view('programas.edit', compact('programa', 'facultades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Request()->validate([
            'nombre'=>'required|string|unique:programas,nombre|max:100',
            'facultad_id'=>'required|numeric|max:1000',

        ],[
            'nombre.required'=>'El nombre es requerido.',
            'nombre.required'=>'Este programa ya existe'
        ]);
        $programa = Programa::findOrFail($id);
        DB::transaction(function() use ($data, $programa){
            $programa->update([
                'nombre' => $data['nombre'],
                'facultad_id' => $data['facultad_id'],
            ]);

        });

        return redirect()->route('programas.index')->with('message','Programa modificado con éxito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Programa::destroy($id);
        return redirect()->route('programas.index')->with('message', "Programa eliminado con exito!!");
    }
}
