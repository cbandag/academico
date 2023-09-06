<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use Illuminate\Http\Request;

class PlanesDeTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planes = Actividades::all();
        return view('actividad.index', $planes);
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
