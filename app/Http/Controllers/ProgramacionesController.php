<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use App\Models\AsignaturasPorDocente;
use App\Models\User;
use App\Models\Asignaciones;
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
            foreach ($docentes as $key => $docente) {
                User::updateOrCreate([
                    'identificacion' => $docente->ide
                ],[
                    'nombres' => $docente->nombres,
                    'apellidos' => $docente->apellidos,
                    //'email' => '',
                    'password' => Hash::make($docente->ide),
                    'estado' => ('ACTIVO')
                ])->assignRole('docente');

                if ($docente->npqprf=='Planta') {
                    $docente->npqprf='TIEMPO COMPLETO';
                    $horas_dedicacion='40';
                }else if ($docente->npqprf=='Catedra') {
                    $docente->npqprf='MEDIO TIEMPO';
                    $horas_dedicacion='20';
                }

                Asignaciones::updateOrCreate([
                    'identificacion' => $docente->ide,
                    'año' => $docente->año,
                    'periodo' => $docente->periodo
                ],[
                    'dedicacion' => $docente->npqprf,
                    'horas_dedicacion' => $horas_dedicacion,
                    //'estado' => ('ACTIVO'),
                ]);
            }

        });
        return redirect()->route('programaciones.index')->with('message','Docentes importados con éxito!!');

    }
    public function importAsignaturasPorDocente()
    {
        $asignaturas = DB::connection('pgsql')->table('programaciones')
        ->select('programaciones.*')
        ->orderBy('programaciones.ide','desc')
        ->get();

        //$docentes =compact('docentes');

        DB::transaction(function() use ($asignaturas){
            foreach ($asignaturas as $key => $asignatura) {
                AsignaturasPorDocente::updateOrCreate([
                    'identificacion' => $asignatura->ide,
                    'codigo_asignatura' => $asignatura->codigo_materia,
                    'grupo' => $asignatura->grupo,
                    'año' => $asignatura->año,
                    'periodo' => $asignatura->periodo
                ],[
                    'horas' => $asignatura->horas,
                    'asignatura' => $asignatura->materia,
                    'programa' => $asignatura->programa
                ]);
            }

        });

        return redirect()->route('programaciones.index')->with('message','Las asignaturas fueron importadas para cada docente, de manera exitosa.');

    }
}
