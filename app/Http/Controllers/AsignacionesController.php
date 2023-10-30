<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Funcion;
use App\Models\User;
use App\Models\Periodo;
use App\Models\AsignaturasPorDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\AsignacionesExport;
//use Maatwebsite\Excel\Facades\Excel;
use Excel;
use Auth;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodos = Periodo::all();
        $periodoActual=Periodo::where('estado','=','ACTIVO')->first();

        if ($periodoActual->first() !== null) {
            $siPeriodoActivo = true;
        }else{
            $siPeriodoActivo = false;
        }

        $asignaciones = Asignacion::
        where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
        ->where('asignaciones.periodo','=',  isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
        ->orderBy('identificacion_jefe')->get();

        $users = User::all();
        $asignaturas = AsignaturasPorDocente::all();
        $funciones = Funcion::all();
        return view('asignaciones.index', compact('periodoActual','periodos','siPeriodoActivo','asignaciones','users','asignaturas','funciones'));
    }

    public function jefe($id)
    {
        if ($id==Auth::user()->id) {
            $periodos = Periodo::all();
            $periodoActual=Periodo::where('estado','=','ACTIVO')->first();

            if ($periodoActual->first() !== null) {
                $siPeriodoActivo = true;
            }else{
                $siPeriodoActivo = false;
            }

            $asignaciones = Asignacion::where('identificacion_jefe','=', User::find($id)->identificacion)
            /*->where('año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('periodo','=',  isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->orderBy('identificacion_jefe')*/->get();

            $users = User::all();
            $asignaturas = AsignaturasPorDocente::all();
            $funciones = Funcion::all();
            return view('asignaciones.index', compact('periodoActual','periodos','siPeriodoActivo','asignaciones','users','asignaturas','funciones'));
        }else{
            return view('home');
        }
    }






    public function año(Request $request)
    {
        $año_periodo = explode("-", $request['año_periodo_seleccionado']);

        $año = $año_periodo[0];
        $periodo = $año_periodo[1];

        $años_periodos = DB::table('asignaciones')->select('año', 'periodo')->GROUPBY('año', 'periodo')->orderBy('año','DESC')->orderBy('periodo','DESC')->get();
        $asignaciones = Asignacion::where('año','=',$año)->where('periodo','=',$periodo)->get();
        //$asignaciones = Asignacion::where('año','=','2023')->where('periodo','=','2')->get();

        $users = User::all();
        $asignaturas = AsignaturasPorDocente::all();
        $funciones = Funcion::all();

        return view('asignaciones.index', compact('asignaciones','users','asignaturas','funciones','años_periodos','año','periodo'));
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
        foreach ($asignacion->funcion as $key => $id_funcion) {
            array_push($funcionesSeleccionadas, $id_funcion->id);
        }
    return view('asignaciones.edit', compact('asignacion','funciones','funcionesSeleccionadas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::findorFail($id);
        $funcion = Funcion::All();

        $horas_dedicacion = $request['horas_dedicadas'];

        $data = Request()->validate([
            'horas_dedicadas'=> 'numeric',
            'descarga_investigacion'=>'numeric|integer|min:0|max:'. ($horas_dedicacion)/2 .'',
            'descarga_extension'=>'numeric|integer|min:0|max:'. ($horas_dedicacion)/2 .'',
            'soporte'=>'string|nullable|max:255',
            'observaciones'=>'string|nullable|max:255',
            'estado'=>'required|string|in:APROBADO,PENDIENTE',
        ],[
            /*'periodo.required'=>'El periodo es requerido.',
            'periodo.unique'=>'Este periodo ya existe.',
            'estado.required'=>'El estado es requerido.'*/
        ]);



        $descarga_investigacion = $data['descarga_investigacion'];
        $descarga_extension = $data['descarga_extension'];
        $porcentaje_investigacion = $descarga_investigacion>($horas_dedicacion*0.5) ? 0.5:($descarga_investigacion/$horas_dedicacion);
        $porcentaje_extension = $descarga_extension>($horas_dedicacion*0.5) ? 0.5:($descarga_extension/$horas_dedicacion);

        $suma_funciones=0;
        foreach ($request->all() as $key => $idFuncion) {
            if (str_contains($key,'funcion_')) {
                if(isset($idFuncion)){
                    $suma_funciones += Funcion::find($idFuncion)->descarga;
                }

            }
        }
        $total_descargas = $suma_funciones + $porcentaje_investigacion + $porcentaje_extension;

        $total_descargas>1?$total_descargas=1:$total_descargas=$total_descargas;
        $horas_restantes = (1 - $total_descargas)*$horas_dedicacion;

        //$horas_clases = round($horas_restantes * 0.4 , 0);
        //$horas_clases = '0.' . explode(',',$horas_restantes * 0.4);
        //$horas_clases =  (($horas_restantes - intval($horas_restantes))*100)/100;

        /*if(explode(',',$horas_restantes * 0.4) >= 0.5){

        }*/
        $horas_preparacion= $horas_restantes * 0.3;
        $horas_estudiantes= $horas_restantes * 0.25;

        DB::transaction(function() use ($data, $request, $asignacion, $porcentaje_investigacion,$porcentaje_extension,$total_descargas,$horas_restantes,$horas_clases,$horas_preparacion,$horas_estudiantes){
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
                'horas_preparacion_ajustada'=>$horas_preparacion,
                'horas_estudiantes_ajustada'=>$horas_estudiantes,
                'observaciones'=>$data['observaciones'],
                //'horas_docencia'=>$horas_docencia,
                'estado'=>$data['estado']
            ]);

            $asignacion->funcion()->detach();//elimina todos las funciones de asignacion
            $id=array();
            foreach ($request->all() as $key => $idFuncion) {
                if (str_contains($key,'funcion_')) {
                    if(isset($idFuncion)){
                        //$asignacion->funcion()->attach($idFuncion);
                        array_push($id, $idFuncion);

                    }
                }
            }
            $asignacion->funcion()->sync($id);



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

    public function importar(Request $request){
        if($request->hasFile('documento')){
            $path = $request->file('documento')->getRealPath();
            $datos = Excel::load($path, function($reader){})->get();

            if (!empty($datos) && $datos->count()){
                $datos = $datos->toArray();

                for($i=0;$i<count($datos);$i++){
                    $datosImportar[] = $datos[$i];
                }


            }
            Asignaciones::insert();
        }
        return back();
    }

    public function export()
    {

        return Excel::download(new AsignacionesExport,'asignaciones.xlsx');

        //return Excel::download(new InvoicesExport, 'invoices.xlsx', true, ['X-Vapor-Base64-Encode' => 'True']);


    }
}
