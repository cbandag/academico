<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Funcion;
use App\Models\User;
use App\Models\AsignaturasPorDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaciones = Asignacion::where('año','=','2023')->where('periodo','=','2')->get();
        $users = User::all();
        $asignaturas = AsignaturasPorDocente::all();
        $funciones = Funcion::all();

        return view('asignaciones.index', compact('asignaciones','users','asignaturas','funciones'));
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
    public function show(asignaciones $asignaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $asignacion = Asignacion::findorFail($id);
        $funciones = Funcion::all();
        //$funciones = Funcion::findorFail($id);
        return view('asignaciones.edit', compact('asignacion','funciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Request()->validate([
            'funcion_1'=>'numeric',
            'funcion_2'=>'numeric',
            'funcion_3'=>'numeric',
            'funcion_4'=>'numeric',
            'descarga_investigacion'=>'numeric',
            'descarga_extension'=>'numeric',
            'soporte'=>'string|max:255',
            'observaciones'=>'string|max:255',
            'estado'=>'|max:10',
            'estado'=>'required|string|in:LISTO,PENDIENTE',
        ],[
            /*'periodo.required'=>'El periodo es requerido.',
            'periodo.unique'=>'Este periodo ya existe.',
            'estado.required'=>'El estado es requerido.'*/
        ]);

        $asignacion = Asignacion::findorFail($id);
        $funcion = Funcion::All();

        $horas_dedicacion = $asignacion->horas_dedicacion;
        ($data['funcion_1']==0 ? $funcion_1=0 : $funcion_1 = Funcion::find($data['funcion_1'])->descarga );
        ($data['funcion_1']==0 ? $funcion_2=0 : $funcion_2 = Funcion::find($data['funcion_2'])->descarga );
        ($data['funcion_1']==0 ? $funcion_3=0 : $funcion_3 = Funcion::find($data['funcion_3'])->descarga );
        ($data['funcion_1']==0 ? $funcion_4=0 : $funcion_4 = Funcion::find($data['funcion_4'])->descarga );

        $descarga_investigacion = $data['descarga_investigacion'];
        $descarga_extension = $data['descarga_extension'];
        $porcentaje_investigacion = ($horas_dedicacion>0.5)?0.5:($descarga_investigacion/$horas_dedicacion);
        $porcentaje_extension = ($horas_dedicacion>0.5)?0.5:($descarga_extension/$horas_dedicacion);
        $total_descargas = $funcion_1+$funcion_2+$funcion_3+$funcion_4+$porcentaje_investigacion+$porcentaje_extension;
        $horas_restantes = (1 - $total_descargas)*$horas_dedicacion;
        $horas_clases = $horas_restantes * 0.4;
        $horas_preparacion= $horas_restantes * 0.3;
        $horas_estudiantes= $horas_restantes * 0.25;




        DB::transaction(function() use ($data,$asignacion, $porcentaje_investigacion,$porcentaje_extension,$total_descargas,$horas_restantes,$horas_clases,$horas_preparacion,$horas_estudiantes){
            $asignacion->update([
                'descarga_investigacion'=>$data['descarga_investigacion'],
                'porcentaje_investigacion'=>$porcentaje_investigacion,
                'descarga_extension'=>$data['descarga_extension'],
                'porcentaje_extension'=>$porcentaje_extension,
                'total_descargas'=>$total_descargas,
                'horas_restantes'=>$horas_restantes,
                'soporte'=>$data['soporte'],
                'horas_clases'=>$horas_clases,
                'horas_preparacion'=>$horas_preparacion,
                'horas_estudiantes'=>$horas_estudiantes,
                'observaciones'=>$data['observaciones'],
                //'horas_docencia'=>$horas_docencia,
                'estado'=>$data['estado']
            ]);

            $data['funcion_1']>0 ? $asignacion->funcion()->attach($data['funcion_1']):'';
            $data['funcion_2']>0 ? $asignacion->funcion()->attach($data['funcion_2']):'';
            $data['funcion_3']>0 ? $asignacion->funcion()->attach($data['funcion_3']):'';
            $data['funcion_4']>0 ? $asignacion->funcion()->attach($data['funcion_4']):'';

        });

        return redirect()->route('periodos.index')->with('message','Asignacion guardada con éxito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asignaciones $asignaciones)
    {
        //
    }
}
