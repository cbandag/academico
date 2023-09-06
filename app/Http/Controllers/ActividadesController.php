<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Periodo;
use App\Models\User;
use App\Models\Programa;
use App\Models\Facultad;

use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actividades = Actividad::all();
        $periodos = Periodo::all();
        $users = User::all();
        $programa = Programa::all();
        $facultad = Facultad::all(); 

        return view('actividades.index', compact('actividades','periodos','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show(actividades $actividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(actividades $actividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, actividades $actividades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(actividades $actividades)
    {
        //
    }
}
