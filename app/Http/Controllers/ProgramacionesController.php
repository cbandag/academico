<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProgramacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = DB::connection('pgsql')->table('programaciones')
        ->select('programaciones.*')
        ->distinct('programaciones.ide')
        ->orderBy('programaciones.ide','desc')
        ->get();
        $asignaturas = DB::connection('pgsql')->table('programaciones')
        ->select('programaciones.*')
        ->distinct('programaciones.ide')
        ->orderBy('programaciones.ide','desc')
        ->get();


        $programaciones= Programacion::on('pgsql')->get();//all();
        return view('programaciones.index', compact('programaciones','docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(programaciones $programaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(programaciones $programaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, programaciones $programaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(programaciones $programaciones)
    {
        //
    }

    /**
     * Importa la tabla pgsql programaciones en la tabla docentes, funciones, asignaciones
     */
    public function importDocentes()
    {

        $docentes = DB::connection('pgsql')->table('programaciones')
        ->select('programaciones.*')
        ->distinct('programaciones.ide')
        ->orderBy('programaciones.ide','desc')
        ->get();

        //$docentes =compact('docentes');
        

        DB::transaction(function() use ($docentes){
            User::updateOrCreate([
                'identification' => '8834646'
            ],[
                'nombres' => $docentes['nombres'],
                'apellidos' => $docentes['apellidos'],
                'email' => '',
                'password' => Hash::make($docentes['ide']),
                'estado' => ('ACTIVO'),
            ])->assignRole('docente');

        });
        
        //return redirect()->route('docentes.index')->with('message','Docentes importados con éxito!!');
    

        //return view('users.index', compact('docentes','jefes','model','route','title'));

    }
}
