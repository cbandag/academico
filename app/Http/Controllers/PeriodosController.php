<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PeriodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        
        

        $periodos= Periodo::all();
        return view('periodos.index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periodos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Request()->validate([
            'periodo'=>'required|string|unique:periodos,periodo|max:7',
            'estado'=>'required|string|in:ACTIVO,INACTIVO|max:8',

        ],[
            'periodo.required'=>'El periodo es requerido.',
            'estado.required'=>'El estado es requerido.'
        ]);

        DB::transaction(function() use ($data){
            Periodo::create([
                'periodo' => $data['periodo'],
                'estado' => $data['estado'],
            ]);

        });

        return redirect()->route('periodos.index')->with('message','Periodo creado con éxito!!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $periodo = Periodo::findOrFail($id);

        return view('periodos.show', compact('periodo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periodo = Periodo::findOrFail($id);

            

        return view('periodos.edit', compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Request()->validate([
            'periodo'=>'required|string|unique:periodos,periodo|max:7',
            'estado'=>'required|string|in:ACTIVO,INACTIVO',

        ],[
            'periodo.required'=>'El periodo es requerido.',
            'periodo.unique'=>'Este periodo ya existe.',
            'estado.required'=>'El estado es requerido.'
        ]);
        $periodo = Periodo::findOrFail($id);

        DB::transaction(function() use ($data,$periodo){
            $periodo->update([
                'periodo' => $data['periodo'],
                'estado' => $data['estado'],
            ]);

        });

        return redirect()->route('periodos.index')->with('message','Periodo modificado con éxito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Periodo::destroy($id);
        return redirect()->route('periodos.index')->with('message','Periodo eliminado con éxito!!');
    }
}
