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
        return view('periodo.index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periodo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Request()->validate([
            'periodo'=>'required|string|max:7',
            'estado'=>'required|string|max:8',

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

        return redirect()->route('periodo.index')->with('message','Periodo creado con éxito!!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $periodo = Periodo::findOrFail($id);

        return view('periodo.show', compact('periodo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periodo = Periodo::findOrFail($id);

        

        return view('periodo.edit', compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Request()->validate([
            'periodo'=>'required|string|max:7',
            'estado'=>'required|string|max:8',

        ],[
            'periodo.required'=>'El periodo es requerido.',
            'estado.required'=>'El estado es requerido.'
        ]);
        $periodo = Periodo::findOrFail($id);

        DB::transaction(function() use ($data,$periodo){
            $periodo->update([
                'periodo' => $data['periodo'],
                'estado' => $data['estado'],
            ]);

        });

        return redirect()->route('periodo.index')->with('message','Periodo creado con éxito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Periodo::destroy($id);
        return redirect()->route('periodo.index')->with('message','Periodo eliminado con éxito!!');
    }
}
