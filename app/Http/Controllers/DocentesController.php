<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Excel;
use App\Imports\JefesImport;
use App\Exports\JefesExport;
use App\Imports\DocentesImport;
use App\Exports\DocentesExport;

class DocentesController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodoActual=Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();

        $jefes = DB::table('users')
        ->leftjoin('jefes_por_periodo', 'users.identificacion', '=', 'jefes_por_periodo.identificacion_jefe')
        ->select('users.*')
        ->where('jefes_por_periodo.año','=',$periodoActual->año)
        ->where('jefes_por_periodo.periodo','=',$periodoActual->periodo)
        ->get();

        $docentes = DB::table('asignaciones')
        ->leftjoin('users AS docentes', 'asignaciones.identificacion_docente', '=', 'docentes.identificacion')
        ->leftjoin('users AS jefes', 'asignaciones.identificacion_jefe', '=', 'jefes.identificacion')
        ->select('docentes.*','asignaciones.*','jefes.nombres AS nombre_jefe','jefes.apellidos AS apellido_jefe')
        ->where('asignaciones.año','=', $periodoActual->año)
        ->where('asignaciones.periodo','=', $periodoActual->periodo)
        ->get();

        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';

        $años_periodos = DB::table('asignaciones')->select('año', 'periodo')->GROUPBY('año', 'periodo')->orderBy('año','DESC')->orderBy('periodo','DESC')->get();
/*
        !isset($años_periodos->first()->año)     ? $año='0000'     : $año = $años_periodos->first()->año;
        !isset($años_periodos->first()->periodo) ? $periodo='0' : $periodo = $años_periodos->first()->periodo;
        $año_periodo_seleccionado='1';
*/
        return view('users.index', compact('periodoActual','periodos','jefes','docentes','model','route','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jefes = DB::table('users')
        ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*', 'model_has_roles.model_id')
        ->where('roles.name','like','jefe')
        ->get();
        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return view('users.create', compact('jefes','model','route','title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Request()->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
            'identificacion' => ['required', 'string', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'jefe' => ['numeric'],
            'estado'=>'required|string|in:ACTIVO,INACTIVO|max:8',
        ],[
            'nombres.required' => 'El nombre es requerido.',
            'apellidos.required' => 'El apellido es requerido.',
            'email.required' => 'El email es requerido.',
            'identificacion.required' => 'La identificacion es requerido.',
            'password.required' => 'La password es requerido.',
            'estado.required'=>'El estado es requerido.'
        ]);

        DB::transaction(function() use ($data){
            User::create([
                'nombres' => $data['nombres'],
                'apellidos' => $data['apellidos'],
                'email' => $data['email'],
                'identificacion' => $data['identificacion'],
                'password' => Hash::make($data['password']),
                'estado' => ($data['estado']),
            ])->assignRole('docente');

        });
        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return redirect()->route('docentes.index','model','route','title')->with('message','Docente creado con éxito!!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $user = User::findOrFail($id);
        $jefes = DB::table('users')
        ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*', 'model_has_roles.role_id')
        ->where('roles.name','like','jefe')
        ->get();
        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return view('users.show', compact('user','jefes','model','route','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $jefes = DB::table('users')
        ->leftjoin('jefes_por_periodo', 'users.identificacion', '=', 'jefes_por_periodo.identificacion_jefe')
        ->select('users.*')
        ->where('jefes_por_periodo.año','=','2023')
        ->where('jefes_por_periodo.periodo','=','2')
        ->get();


        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return view('users.edit', compact('user','jefes','model','route','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        if ($request['password'] != null && $request['password_confirmation'] != null) {
            //$request['password'] = $request['password'];
            //$request['password_confirmation'] = $request['password'];
        }else{
            $user=User::findOrFail($id);
            $request['password'] = $user->password;
            $request['password_confirmation'] = $user->password;

            //$request['password_confirmation'] = $user->password;
        }

        $data = Request()->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:25', 'unique:users,email,'.$id],
            'identificacion' => ['required', 'string', 'max:25', 'unique:users,identificacion,'.$id],
            'password' => ['string', 'min:8', 'confirmed'],
            'jefe' => ['numeric'],
            'estado'=>'required|string|in:ACTIVO,INACTIVO|max:8',
        ],[
            'nombres.required' => 'El nombre es requerido.',
            'apellidos.required' => 'El apellido es requerido.',
            'email.required' => 'El email es requerido.',
            'identificacion.required' => 'La identificacion es requerido.',
            'estado.required'=>'El estado es requerido.',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);

        $data['password'] = Hash::make($request['password']);





        $user = User::findOrFail($id);
        DB::transaction(function() use ($data,$user){
            $user->update([
                'nombres' => $data['nombres'],
                'apellidos' => $data['apellidos'],
                'email' => $data['email'],
                'identificacion' => $data['identificacion'],
                'password' => $data['password'],
                'estado' => ($data['estado']),
            ]);

        });
        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return redirect()->route('docentes.index')->with('message','Docente modificado con éxito!!');
    }

    public function importAll(Request $request)
    {
        //toca consultar en la tabla pgsql agrupando los docentes por su cedula
        //luego crearlos si no existen
        //en el controlador de actividades o asignaturas sql toca agregar las horas por actividad
        // de cada docente se unen atraves de la cedula del docente
        //toca crear otra tabla con los calculos de la suma de horas

        //cambiar programacio por asignacion

        $users = DB::connection('pgsql')->table('asignaciones')
        ->select('asignaciones.*')
        ->groupBy('ide')
        ->having('roles.name','like','docente')
        ->get();

        $jefes = DB::table('users')
        ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*', 'model_has_roles.model_id')
        ->where('roles.name','like','jefe')
        ->get();

        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';

        return view('users.index', compact('users','jefes','model','route','title'));


        $data = Request()->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
            'identificacion' => ['required', 'string', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'jefe' => ['numeric'],
            'estado'=>'required|string|in:ACTIVO,INACTIVO|max:8',
        ],[
            'nombres.required' => 'El nombre es requerido.',
            'apellidos.required' => 'El apellido es requerido.',
            'email.required' => 'El email es requerido.',
            'identificacion.required' => 'La identificacion es requerido.',
            'password.required' => 'La password es requerido.',
            'estado.required'=>'El estado es requerido.'
        ]);

        DB::transaction(function() use ($data){
            User::create([
                'nombres' => $data['nombres'],
                'apellidos' => $data['apellidos'],
                'email' => $data['email'],
                'identificacion' => $data['identificacion'],
                'password' => Hash::make($data['password']),
                'estado' => ($data['estado']),
            ])->assignRole('docente');;

        });
        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return redirect()->route('docentes.index','model','route','title')->with('message','Docente creado con éxito!!');
    }






    /**
     * Remove the specified resource from storage.

    public function destroy( $id)
    {
        User::destroy($id);
        return redirect()->route('docentes.index')->with('message','Periodo eliminado con éxito!!');
    }
    */

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
            Docentes::insert();
        }
        return back();
    }

    public function export()
    {

        return Excel::download(new DocentesExport,'docentes.xlsx');

        //return Excel::download(new InvoicesExport, 'invoices.xlsx', true, ['X-Vapor-Base64-Encode' => 'True']);


    }

    public function importJefes(Request $request){
        $request->validate([
            'documento' => 'required|file|mimes:xls,xlsx'
        ]);
        Excel::import(new JefesImport, $request->file('documento'));
        return redirect()->route('docentes.index')->with('message','Jefes importados con éxito!!');

    }

    public function importDocentes(Request $request){
        $request->validate([
            'documento' => 'required|file|mimes:xls,xlsx'
        ]);
        Excel::import(new DocentesImport, $request->file('documento'));
        return redirect()->route('docentes.index')->with('message','Docentes importados con éxito!!');

    }

    public function docentesPorJefe($identificacion)
    {

        $docentes = DB::table('asignaciones')
        ->leftjoin('users AS docentes', 'asignaciones.identificacion_docente', '=', 'docentes.identificacion')
        ->leftjoin('users AS jefes', 'asignaciones.identificacion_jefe', '=', 'jefes.identificacion')
        ->select('docentes.*','asignaciones.*','jefes.nombres AS nombre_jefe','jefes.apellidos AS apellido_jefe')
        ->where('asignaciones.identificacion_jefe','=',$identificacion)
        ->get();


        return response()->json($docentes);

    }



}
