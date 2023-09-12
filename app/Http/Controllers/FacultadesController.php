<?php

namespace App\Http\Controllers;


use App\Models\Facultad;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FacultadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facultades= Facultad::all();
        return view('facultades.index', compact('facultades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facultades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Request()->validate([

            'nombre'=>'required|string|unique:facultades,nombre|max:50',
        ],[
            
            'nombre.required'=> 'El nombre de la facultad es requirido'

        ]);

        DB::transaction(function () use ($data){
            Facultad::create([
                'nombre' => $data['nombre'],
            ]);
        });

        return redirect()->route('facultades.index')->with('message', 'Facultad creada con éxito!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $facultad = Facultad::findOrFail($id);
        return view('facultades.show', compact('facultad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $facultad = Facultad::findOrFail($id);
        return view('facultades.edit', compact('facultad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Request()->validate([

            'nombre'=>'required|string|unique:facultades,nombre|max:50',
        ],[
            
            'nombre.required'=> 'El nombre de la facultad es requirido',
            'nombre.unique' => 'Esta facultad ya existe'
        ]);
        $facultad = Facultad::findOrFail($id);
        DB::transaction(function () use ($data, $facultad){
            $facultad->update([
                'nombre' => $data['nombre'],
            ]);
        });

        return redirect()->route('facultades.index')->with('message', 'Facultad modificada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Facultad::destroy($id);
        return redirect()->route('facultades.index')->with('message',"Facultad eliminada con exito!");
    }
}
