<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use App\Models\AsignaturasPorDocente;
use App\Models\User;
use App\Models\Asignacion;
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

        $programaciones = DB::connection('pgsql')->table('programaciones')
        ->select('programaciones.*')
        ->where('npqprf','=','Planta')
        ->distinct('programaciones.ide')
        ->orderBy('programaciones.ide','desc')
        ->get();

        //$docentes =compact('docentes');


        DB::transaction(function() use ($programaciones){
            foreach ($programaciones as $key => $programacion) {
                User::updateOrCreate([
                    'identificacion' => $programacion->ide
                ],[
                    'nombres' => $programacion->nombres,
                    'apellidos' => $programacion->apellidos,
                    //'email' => '',
                    'password' => Hash::make($programacion->ide),
                    'estado' => ('ACTIVO')
                ])->assignRole('docente');
/*
                if ($programacion->npqprf=='Planta') {
                    $programacion->npqprf='TIEMPO COMPLETO';
                    $horas_dedicacion='40';
                }else if ($docente->npqprf=='Catedra') {
                    $docente->npqprf='MEDIO TIEMPO';
                    $horas_dedicacion='20';
                }
*/
                Asignacion::updateOrCreate([
                    'identificacion' => $programacion->ide,
                    'año' => $programacion->año,
                    'periodo' => $programacion->periodo
                ],[
                    'dedicacion' => $programacion->npqprf,
                    //'horas_dedicacion' => 40,
                    'estado' => 'PENDIENTE'
                ]);
            }

        });
        return redirect()->route('programaciones.index')->with('message','Docentes importados con éxito!!');

    }
    public function importAsignaturasPorDocente()
    {
        $asignaturas = DB::connection('pgsql')->table('programaciones')
            ->select('programaciones.*')
            ->where('npqprf','=','Planta')
            ->orderBy('programaciones.ide','desc')
            ->get();
        $lista_horas_docencia = DB::connection('pgsql')->table('programaciones')
            ->where('npqprf','=','Planta')
            ->select('ide','año','periodo', DB::raw(' SUM(horas) as total_horas'))
            ->groupBy('ide','año','periodo')
            ->get();

        //$docentes =compact('docentes');

        DB::transaction(function() use ($asignaturas, $lista_horas_docencia){
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

            foreach ($lista_horas_docencia as $horas_docencia) {
                Asignacion::updateOrCreate([
                    'identificacion' => $horas_docencia->ide,
                    'año' => $horas_docencia->año,
                    'periodo' => $horas_docencia->periodo
                ],[
                    'horas_docencia' => $horas_docencia->total_horas,
                ]);
            }


        });

        return redirect()->route('programaciones.index')->with('message','Las asignaturas fueron importadas para cada docente, de manera exitosa.');

    }
}
