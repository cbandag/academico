<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\User;
use App\Models\AsignaturasPorDocente;
use Illuminate\Http\Request;

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

        return view('asignaciones.index', compact('asignaciones','users','asignaturas'));
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
    public function edit(asignaciones $asignaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, asignaciones $asignaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asignaciones $asignaciones)
    {
        //
    }
}
