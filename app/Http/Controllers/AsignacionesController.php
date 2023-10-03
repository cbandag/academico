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
        $funcionesSeleccionadas=array();
        foreach ($asignacion->funcion as $id_funcion) {
            array_push($funcionesSeleccionadas, $id_funcion->id);
        }
    return view('asignaciones.edit', compact('asignacion','funciones','funcionesSeleccionadas'/*,'funcion_2','funcion_3','funcion_4'*/));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $horas_dedicacion = $request['horas_dedicadas'];
        $data = Request()->validate([
            'horas_dedicadas'=> 'numeric',
            'funcion_1'=>'numeric|integer|nullable',
            'funcion_2'=>'numeric|integer|nullable',
            'funcion_3'=>'numeric|integer|nullable',
            'funcion_4'=>'numeric|integer|nullable',
            'descarga_investigacion'=>'numeric|integer|min:0|max:'. ($horas_dedicacion) .'',
            'descarga_extension'=>'numeric|integer|digits_between:0,'. ($horas_dedicacion) .'',
            'soporte'=>'string|nullable|max:255',
            'observaciones'=>'string|nullable|max:255',
            'estado'=>'required|string|in:LISTO,PENDIENTE',
        ],[
            /*'periodo.required'=>'El periodo es requerido.',
            'periodo.unique'=>'Este periodo ya existe.',
            'estado.required'=>'El estado es requerido.'*/
        ]);

        $asignacion = Asignacion::findorFail($id);
        $funcion = Funcion::All();


        ($data['funcion_1']=='' ? $funcion_1=0 : $funcion_1 = Funcion::find($data['funcion_1'])->descarga );
        ($data['funcion_2']=='' ? $funcion_2=0 : $funcion_2 = Funcion::find($data['funcion_2'])->descarga );
        ($data['funcion_3']=='' ? $funcion_3=0 : $funcion_3 = Funcion::find($data['funcion_3'])->descarga );
        ($data['funcion_4']=='' ? $funcion_4=0 : $funcion_4 = Funcion::find($data['funcion_4'])->descarga );

        $descarga_investigacion = $data['descarga_investigacion'];
        $descarga_extension = $data['descarga_extension'];
        $porcentaje_investigacion = $descarga_investigacion>($horas_dedicacion*0.5) ? 0.5:($descarga_investigacion/$horas_dedicacion);
        $porcentaje_extension = $descarga_extension>($horas_dedicacion*0.5) ? 0.5:($descarga_extension/$horas_dedicacion);
        $total_descargas = $funcion_1+$funcion_2+$funcion_3+$funcion_4+$porcentaje_investigacion+$porcentaje_extension;
        $total_descargas>1?$total_descargas=1:$total_descargas=$total_descargas;
        $horas_restantes = (1 - $total_descargas)*$horas_dedicacion;
        $horas_clases = $horas_restantes * 0.4;
        $horas_preparacion= $horas_restantes * 0.3;
        $horas_estudiantes= $horas_restantes * 0.25;




        DB::transaction(function() use ($data,$asignacion, $porcentaje_investigacion,$porcentaje_extension,$total_descargas,$horas_restantes,$horas_clases,$horas_preparacion,$horas_estudiantes){
            $asignacion->update([
                'horas_dedicacion'=>$data['horas_dedicadas'],
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

            $asignacion->funcion()->detach();//elimina todos las funciones de asignacion

            $data['funcion_1']!='' ? $asignacion->funcion()->attach($data['funcion_1']):'';
            $data['funcion_2']!='' ? $asignacion->funcion()->attach($data['funcion_2']):'';
            $data['funcion_3']!='' ? $asignacion->funcion()->attach($data['funcion_3']):'';
            $data['funcion_4']!='' ? $asignacion->funcion()->attach($data['funcion_4']):'';

            //$asignacion->funcion()->sync([$data['funcion_1'],$data['funcion_2'],$data['funcion_3'],$data['funcion_3']]);
        });

        return redirect()->route('asignaciones.index')->with('message','Asignacion guardada con éxito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asignaciones $asignaciones)
    {
        //
    }
}
