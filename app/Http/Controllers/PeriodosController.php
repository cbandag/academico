<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Imports\PeriodosImport;
use App\Exports\PeriodosExport;

use App\Models\User;

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
            'año'=>'required|string|unique:periodos,periodo|max:4',
            'periodo'=>'required|string|unique:periodos,año|max:2',
            'estado'=>'required|string|in:ACTIVO,INACTIVO',
        ],[
            'año.required'=>'El año es requerido.',
            'periodo.required'=>'El periodo es requerido.',
            'estado.required'=>'El estado es requerido.'
        ]);

        DB::transaction(function() use ($data){
            if($data['estado']=='ACTIVO' && Periodo::first() !== null ){
                Periodo::all()->update(['estado' => 'INACTIVO']);
            }
            Periodo::create([
                'año' => $data['año'],
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
            //'año'=>'required|string|unique:periodos,periodo|max:4',
            //'periodo'=>'required|string|unique:periodos,año|max:2',
            'estado'=>'required|string|in:INACTIVO,ACTIVO',
        ],[
            //'año.required'=>'El año es requerido.',
            //'periodo.required'=>'El periodo es requerido.',
            'estado.required'=>'El estado es requerido.'
        ]);
        $periodo = Periodo::findOrFail($id);

        DB::transaction(function() use ($data,$periodo){
            if($data['estado']=='ACTIVO'){
                Periodo::where('estado','=','ACTIVO')->update(['estado' => 'INACTIVO']);
            }
            $periodo->update([
                //'año' => $data['año'],
                //'periodo' => $data['periodo'],
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


    public function import(Request $request){
        $request->validate([
            'documento' => 'required|file|mimes:xls,xlsx'
        ]);
        Excel::import(new PeriodosImport, $request->file('documento'));
        return redirect()->route('periodos.index')->with('message','Periodos importados con éxito!!');


        /*if($request->hasFile('documento')){
            $path = $request->file('documento')->getRealPath();
            $datos = Excel::load($path, function($reader){})->get();
            if (!empty($datos) && $datos->count()){
                $datos = $datos->toArray();
                for($i=0;$i<count($datos);$i++){
                    $datosImportar[] = $datos[$i];
                }
            }
            Periodos::insert($datosImportar);
        }*/

    }

    public function export()
    {
        return Excel::download(new PeriodosExport,'periodos.xlsx');
        //return Excel::download(new PeriodosExport, 'periodos.xlsx', true, ['X-Vapor-Base64-Encode' => 'True']);
    }
}
