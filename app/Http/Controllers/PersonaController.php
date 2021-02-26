<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $persona = Persona::all();
        return $persona;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $persona = new Persona();
        $persona->documento=$request->documento;
        $persona->nombre=$request->nombre;
        $persona->apellido=$request->apellido;
        $persona->edad=$request->edad;
        $persona->genero=$request->genero;
        $persona->telefono=$request->telefono;
        //$persona->imagen=$request->imagen;
        $persona->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $persona = Persona::FindOrFail($request->id); 
        $persona->documento=$request->documento;
        $persona->nombre=$request->nombre;
        $persona->apellido=$request->apellido;
        $persona->edad=$request->edad;
        $persona->genero=$request->genero;
        $persona->telefono=$request->telefono;
        //$persona->imagen=$request->imagen;
        $persona->save();
        return $persona;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
        $persona = Persona::destroy($request->id);
        return $persona;
    }
}
