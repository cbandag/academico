<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Funcion;
use App\Models\User;
use App\Models\Periodo;
use App\Models\AsignaturasPorDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $asignaciones = Asignacion::where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
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
    public function edit($id)
    {

        //Storage::disk('public')->put('texto.txt','Hola');//guardar un archivo
        /*
        foreach(Storage::disk($this->disk)->files() as $file){
            $name = str_replace("$this->disk/","","$file");
        }
*/

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
        $selecteds = $request->input('funcion.*');
        //$inputs = $request->input('input');
        $fileInputs = $request->file('input');
        //$fileInputs = $request->Allfiles();

        dump($selecteds['0']);
        dump($request->file('input.1'));

        $i=0;
        for($i==0; $i<count($selecteds); $i++){
            if(!empty($selecteds[$i]) /*&& !empty($inputs[$i])*/){
                $nombreFuncion = Funcion::find($selecteds[$i])->funcion;
                //dump($selecteds[$i]);//3
                //dump($inputs[$i]);//3
                //dump($nombreFuncion);//secret...

                $file = $request->file('input.'. $i +1 .'');//'. $i .'
                //$file = $fileInputs['input.1'];//'. $i .'
                //$file->storeAs('', $nombreFuncion, $file->extesion(),'public');
                $file->storeAs('', $nombreFuncion.'.'.$file->extension(),'public');

            }
        }

        /*foreach ($request->all() as $nameSelect => $value) {

                if(str_contains($nameSelect,'funcion_') && isset($value)) {
                    $NombreFuncion = Funcion::find($idFuncion)->funcion;
                }

                if(str_contains($nameInput,'file-' && isset($file))) {
                    $file = $request->file($nameInput);//'file' es el name del input de tipo file
                    //$name = $request->input('nombre');//toma el mombre ingresado en el innput 'nombre'

                }
                $file->storeAs('',$name,$file->extesion(),'public');
            }
        */


/*
        if($request->isMethod('POST')){
            $file = $request->file('file');//'file' es el name del input de tipo file
            $name = $request->input('nombre');//toma el mombre ingresado en el innput 'nombre'
            $file->storeAs('',$name,$file->extesion(),'public');
        }*/


        $asignacion = Asignacion::findorFail($id);
        $funcion = Funcion::All();

        $horas_dedicacion = $asignacion->horas_dedicacion;
        //$request->push('total_descarga', $request['descarga_investigacion'] + $request['descarga_extension']) ;
        $request->request->add(['total_descarga' => $request['descarga_investigacion'] + $request['descarga_extension']]);

        $data = Request()->validate([
            'descarga_investigacion'=>'numeric|integer|min:0',
            'descarga_extension'=>'numeric|integer|min:0',
            'total_descarga'=>'numeric|integer|min:0|max:'. ($horas_dedicacion)/2 .'',
            'observaciones'=>'string|nullable|max:255',
            'estado'=>'required|string|in:APROBADO,PENDIENTE',
        ],[
            'total_descarga'=>'El total de horas de investigación + extension superan el límite: '.($horas_dedicacion)/2 .' horas' ,
        ]);

        $descarga_investigacion = $data['descarga_investigacion'];
        $descarga_extension = $data['descarga_extension'];
        $porcentaje_investigacion = $descarga_investigacion>($horas_dedicacion*0.5) ? 0.5:($descarga_investigacion/$horas_dedicacion);
        $porcentaje_extension = $descarga_extension>($horas_dedicacion*0.5) ? 0.5:($descarga_extension/$horas_dedicacion);

        $suma_funciones=0;
        foreach ($request->all() as $key => $idFuncion) {
            if(str_contains($key,'funcion_')) {
                if(isset($idFuncion)){
                    $suma_funciones += Funcion::find($idFuncion)->descarga;
                }
            }
        }
        $total_descargas = $suma_funciones + $porcentaje_investigacion + $porcentaje_extension;
        $total_descargas>1?$total_descargas=1:$total_descargas=$total_descargas;
        $horas_restantes = (1 - $total_descargas)*$horas_dedicacion;
        //$horas_restantes = $horas_dedicacion - ($descarga_investigacion + $descarga_extension + ($suma_funciones*$horas_dedicacion));

        $horas_clases = round($horas_restantes * 0.4 , 0);

        $horas_preparacion= round($horas_restantes * 0.3 , 0) ;
        $horas_estudiantes= $horas_restantes * 0.25;

        DB::transaction(function() use ($data, $request, $asignacion, $porcentaje_investigacion,$porcentaje_extension,$total_descargas,$horas_restantes,$horas_clases,$horas_preparacion,$horas_estudiantes){
            $asignacion->update([
                'descarga_investigacion'=>$data['descarga_investigacion'],
                'porcentaje_investigacion'=>$porcentaje_investigacion,
                'descarga_extension'=>$data['descarga_extension'],
                'porcentaje_extension'=>$porcentaje_extension,
                'total_descargas'=>$total_descargas,
                'horas_restantes'=>$horas_restantes,
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


        return redirect()->route('asignaciones.jefe', ['id' => Auth::user()->id])->with('message','Asignacion guardada con éxito!!');
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


    public function importAsignaturasPorDocente($id)
    {
        $asignacion = Asignacion::find($id);

        $asignaturasDelDocente = DB::connection('pgsql')->table('programaciones')
            ->select('programaciones.*')
            ->where('npqprf','=','Planta')
            ->where('ide','=',$asignacion->identificacion_docente)
            ->where('año','=', $asignacion->año)
            ->where('periodo','=', $asignacion->periodo)
            ->get();

        $total_horas_docencia = DB::connection('pgsql')->table('programaciones')
            ->where('npqprf','=','Planta')
            ->where('ide','=',$asignacion->identificacion_docente)
            ->where('año','=', $asignacion->año)
            ->where('periodo','=', $asignacion->periodo)
            ->select('ide','año','periodo', DB::raw('SUM(horas) as total_horas'))
            ->groupBy('ide','año','periodo')
            ->first();


        DB::transaction(function() use ( $asignaturasDelDocente, $total_horas_docencia, $asignacion){
            foreach ($asignaturasDelDocente as $key => $asignatura) {
                AsignaturasPorDocente::updateOrCreate([
                    'asignacion_id' => $asignacion->id,
                    'codigo_asignatura' => $asignatura->codigo_materia,
                    'grupo' => $asignatura->grupo,
                ],[
                    'horas' => $asignatura->horas,
                    'asignatura' => $asignatura->materia,
                    'programa' => $asignatura->programa
                ]);
            }

            $asignacion->update([
                'horas_docencia' => $total_horas_docencia->total_horas,
                'estado' => 'PENDIENTE',
            ]);


        });

        return redirect()->route('asignaciones.jefe', Auth::user()->id)->with('message','Las asignaturas fueron importadas para el docente, de manera exitosa.');

    }
}
