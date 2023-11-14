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

class UsuariosController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodoActual=Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();
        if (Periodo::where('periodos.estado','=', 'ACTIVO')->first() !== null) {
            $siPeriodoActivo = true;
        }else{
            $siPeriodoActivo = false;
        }

        $jefes = DB::table('users')
        ->leftjoin('jefes_por_periodo', 'users.identificacion', '=', 'jefes_por_periodo.identificacion_jefe')
        ->select('users.*')
        ->where('jefes_por_periodo.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
        ->where('jefes_por_periodo.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
        ->get();

        $docentes = DB::table('asignaciones')
        ->leftjoin('users AS docentes', 'asignaciones.identificacion_docente', '=', 'docentes.identificacion')
        ->leftjoin('users AS jefes', 'asignaciones.identificacion_jefe', '=', 'jefes.identificacion')
        ->select('docentes.id AS id_docente','docentes.*','asignaciones.*','jefes.nombres AS nombre_jefe','jefes.apellidos AS apellido_jefe')
        ->where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
        ->where('asignaciones.periodo','=',  isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
        ->get();



        return view('users.index', compact('periodoActual','periodos','siPeriodoActivo','jefes','docentes'));
    }

    /**
     * Docentes
     */
    public function createDocentes()
    {
        $periodoActual=Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();

        $jefes = DB::table('users')
            ->leftjoin('jefes_por_periodo', 'users.identificacion', '=', 'jefes_por_periodo.identificacion_jefe')
            ->select('users.*')
            ->where('jefes_por_periodo.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('jefes_por_periodo.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->get();

        return view('users.createDocentes', compact('jefes'));
    }

    public function storeDocentes(Request $request)
    {
        $data = Request()->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
            'identificacion' => ['required', 'string', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'jefe' => ['numeric', 'max:25'],
            'estado'=>'required|string|in:ACTIVO,INACTIVO|max:8',
        ],[
            'nombres.required' => 'El nombre es requerido.',
            'apellidos.required' => 'El apellido es requerido.',
            'email.required' => 'El email es requerido.',
            'identificacion.required' => 'La identificacion es requerido.',
            'password.required' => 'La password es requerido.',
            'estado.required'=>'El estado es requerido.'
        ]);


        if ($request['jefe']) {
            $periodoActual = Periodo::where('estado','=','ACTIVO')->first();
            $jefe = JefesPorPeriodo::
                where('identificacion', $request['jefe'])
                ->where('año', periodoActual->año)
                ->where('periodo', periodoActual->periodo)->first();
            if($jefe){
                $jefe = $request['jefe'];
            }else{
                $jefe = null;
            }
            if($jefe->identificacion_jefe_provisional){
                $jefe_provisional = $jefe->identificacion_jefe_provisional;
            }else{
                $jefe_provisional = null;
            }
        }



        DB::transaction(function() use ($data, $jefe, $jefe_provisional){
            User::create([
                'nombres' => $data['nombres'],
                'apellidos' => $data['apellidos'],
                'email' => $data['email'],
                'identificacion' => $data['identificacion'],
                'password' => Hash::make($data['password']),
                'estado' => ($data['estado']),
            ])->assignRole('docente');



            //$id_jefe =User::find($row['jefe']);
            Asignacion::updateOrCreate([
            //$user->Asignacion()->updateOrCreate([
                'identificacion_docente' => $row['identificacion'],
                'año' => $periodoActual->año,
                'periodo' => $periodoActual->periodo
            ],[
                'identificacion_jefe' => $jefe,
                'identificacion_jefe_provisional' => $jefe_provisional,
                'horas_dedicacion' => $row['horas_dedicacion']/*=='Tiempo Completo'?'40':'20' */,
                'estado' => 'PENDIENTE'
            ]);

        });

        return redirect()->route('usuarios.index')->with('message','Docente creado con éxito!!');
    }

/*
    public function edit($id)
    {
        $periodoActual = Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();
        $user = User::findOrFail($id);

        $jefesProvisionales = DB::table('users')
            ->leftjoin('jefes_provisionales', 'users.identificacion', '=', 'jefes_provisionales.identificacion')
            ->select('users.*','jefes_provisionales.*')
            ->where('jefes_provisionales.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('jefes_provisionales.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->get();

        $jefeProvisionalActual = DB::table('asignaciones')
            ->select('asignaciones.*','identificacion_jefe')
            ->where('identificacion_docente','=',$user->identificacion)
            ->where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('asignaciones.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->first();


        return view('users.editDocentes', compact('user','jefesProvisionales','jefeProvisionalActual'));
    }

*/

    public function editDocentes($id)
    {
        $periodoActual = Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();

        if (Periodo::where('periodos.estado','=', 'ACTIVO')->first() !== null) {
            $siPeriodoActivo = true;
        }else{
            $siPeriodoActivo = false;
        }

        $jefes = DB::table('users')
            ->leftjoin('jefes_por_periodo', 'users.identificacion', '=', 'jefes_por_periodo.identificacion_jefe')
            ->select('users.*')
            ->where('jefes_por_periodo.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('jefes_por_periodo.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->get();

        $user = User::findOrFail($id);

        $jefeActual = DB::table('asignaciones')
            ->select('asignaciones.*','identificacion_jefe')
            ->where('identificacion_docente','=',$user->identificacion)
            /*->where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('asignaciones.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')*/
            ->first();



        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return view('users.show', compact('user','jefes','jefeActual','model','route','title'));
    }














    /**
     * Jefes
     */
    public function createJefes()
    {

        $periodoActual=Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();

        $jefes_provisionales = DB::table('users')
            ->leftjoin('jefes_provisionales', 'users.identificacion', '=', 'jefes_provisionales.identificacion')
            ->select('users.*')
            ->where('jefes_por_periodo.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('jefes_por_periodo.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->get();

        return view('users.createJefes', compact('jefes_provisionales'));
    }

    public function storeJefes(Request $request)
    {
        $data = Request()->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
            'identificacion' => ['required', 'string', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        return redirect()->route('docentes.index')->with('message','Docente creado con éxito!!');
    }

    public function editJefes($id)
    {
        $periodoActual = Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();
        $user = User::findOrFail($id);

        $jefesProvisionales = DB::table('users')
            ->leftjoin('jefes_provisionales', 'users.identificacion', '=', 'jefes_provisionales.identificacion')
            ->select('users.*','jefes_provisionales.*')
            ->where('jefes_provisionales.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('jefes_provisionales.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->get();

        $jefeProvisionalActual = DB::table('asignaciones')
            ->select('asignaciones.*','identificacion_jefe')
            ->where('identificacion_docente','=',$user->identificacion)
            ->where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('asignaciones.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->first();


        return view('users.editJefes', compact('user','jefesProvisionales','jefeProvisionalActual'));
    }















    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $periodoActual = Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();

        if (Periodo::where('periodos.estado','=', 'ACTIVO')->first() !== null) {
            $siPeriodoActivo = true;
        }else{
            $siPeriodoActivo = false;
        }

        $jefes = DB::table('users')
            ->leftjoin('jefes_por_periodo', 'users.identificacion', '=', 'jefes_por_periodo.identificacion_jefe')
            ->select('users.*')
            ->where('jefes_por_periodo.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('jefes_por_periodo.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->get();

        $user = User::findOrFail($id);

        $jefeActual = DB::table('asignaciones')
            ->select('asignaciones.*','identificacion_jefe')
            ->where('identificacion_docente','=',$user->identificacion)
            /*->where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('asignaciones.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')*/
            ->first();



        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return view('users.show', compact('user','jefes','jefeActual','model','route','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periodoActual = Periodo::where('estado','=','ACTIVO')->first();
        $periodos = Periodo::all();

        if (Periodo::where('periodos.estado','=', 'ACTIVO')->first() !== null) {
            $siPeriodoActivo = true;
        }else{
            $siPeriodoActivo = false;
        }

        $jefes = DB::table('users')
            ->leftjoin('jefes_por_periodo', 'users.identificacion', '=', 'jefes_por_periodo.identificacion_jefe')
            ->select('users.*')
            ->where('jefes_por_periodo.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('jefes_por_periodo.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')
            ->get();

        $user = User::findOrFail($id);

        $jefeActual = DB::table('asignaciones')
            ->select('asignaciones.*','identificacion_jefe')
            ->where('identificacion_docente','=',$user->identificacion)
            /*->where('asignaciones.año','=', isset( $periodoActual->año)? $periodoActual->año : '0000')
            ->where('asignaciones.periodo','=', isset( $periodoActual->periodo)? $periodoActual->periodo : '00')*/
            ->first();



        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return view('users.show', compact('user','jefes','jefeActual','model','route','title'));
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

    public function reset_password(Request $request,  $id)
    {
        $user = User::findOrFail($id);
        DB::transaction(function() use ( $user){
            $user->update([
                'password' => Hash::make($user->identificacion),
            ]);
        });
        $model = 'docente';
        $route ='docentes';
        $title ='Docentes';
        return redirect()->route('docentes.index')->with('message','Contraseña restaurada con éxito!!');
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
        return redirect()->route('usuarios.index')->with('message','Jefes importados con éxito!!');

    }

    public function importDocentes(Request $request){
        $request->validate([
            'documento' => 'required|file|mimes:xls,xlsx'
        ]);
        Excel::import(new DocentesImport, $request->file('documento'));
        return redirect()->route('usuarios.index')->with('message','Docentes importados con éxito!!');

    }

    public function docentesPorJefe($identificacion)
    {

        $docentes = DB::table('asignaciones')
        ->leftjoin('users AS docentes', 'asignaciones.identificacion_docente', '=', 'docentes.identificacion')
        ->leftjoin('users AS jefes', 'asignaciones.identificacion_jefe', '=', 'jefes.identificacion')
        ->select('docentes.*','docentes.id as docente_id','asignaciones.*','jefes.nombres AS nombre_jefe','jefes.apellidos AS apellido_jefe')
        ->where('asignaciones.identificacion_jefe','=',$identificacion)
        ->get();


        return response()->json($docentes);

    }



}
