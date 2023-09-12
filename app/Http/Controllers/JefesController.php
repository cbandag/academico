<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class JefesController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
        ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*', 'model_has_roles.model_id')
        ->where('roles.name','like','jefe')
        ->get();

        $jefes = DB::table('users')
        ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*', 'model_has_roles.model_id')
        ->where('roles.name','like','jefe')
        ->get();

        $model = 'jefe';
        $route ='jefes';
        $title ='Jefes';
        
        return view('users.index', compact('users','jefes','model','route','title'));
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
        $model = 'jefe';
        $route ='jefes';
        $title ='Jefes';
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
            ])->assignRole('jefe');;

        });
        $model = 'jefe';
        $route ='jefes';
        $title ='Jefes';
        return redirect()->route('jefes.index','model','route','title')->with('message','Jefe creado con éxito!!');
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
        $model = 'jefe';
        $route ='jefes';
        $title ='Jefes';
        return view('users.show', compact('user','jefes','model','route','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $jefes = DB::table('users')
        ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*', 'model_has_roles.role_id')
        ->where('roles.name','like','jefe')
        ->get();
        $model = 'jefe';
        $route ='jefes';
        $title ='Jefes';
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
        $model = 'jefe';
        $route ='jefes';
        $title ='Jefes';
        return redirect()->route('jefes.index')->with('message','Jefe modificado con éxito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        User::destroy($id);
        return redirect()->route('jefes.index')->with('message','Periodo eliminado con éxito!!');
    }
}
