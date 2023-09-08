<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use Illuminate\Http\Request;

class FacultadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facultades= Facultad::all();
        return view('facultades.index', compact('facultades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facultades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(facultades $facultades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(facultades $facultades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, facultades $facultades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(facultades $facultades)
    {
        //
    }
}
