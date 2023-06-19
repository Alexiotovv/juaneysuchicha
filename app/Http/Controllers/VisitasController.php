<?php

namespace App\Http\Controllers;

use App\Models\visitas;
use App\Models\paises;
use Illuminate\Http\Request;
use DB;
class VisitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cant_vip=DB::table('visitas')
        ->where('tipo_visita','=','VIP')
        ->count();
        $cant_free=DB::table('visitas')
        ->where('tipo_visita','=','FREE')
        ->count();
        $paises=paises::all();
        // ->where('tipo_visita','=','VIP');
        return view('visitas.create_visitas',['cant_free'=>$cant_free ,'cant_vip'=>$cant_vip,'paises'=>$paises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $visitas = new visitas();
        $visitas->dni=request('dni');
        $visitas->nombres=request('nombres');
        $visitas->apellido_paterno=request('apellido_paterno');
        $visitas->apellido_materno=request('apellido_materno');
        $visitas->fecha_nac=request('fecha_nac');
        $visitas->fecha_reg=request('fecha_reg');
        $visitas->hora_reg=request('hora_reg');
        $visitas->tipo_visita=request('tipo_visita');
        
        $visitas->sexo=request('sexo');
        $visitas->origen=request('origen');
        $visitas->pais=request('pais');
        $visitas->ciudad=request('ciudad');
        
        $visitas->medio_viaje=request('medio_viaje');
        $visitas->tiempo_permanencia=request('tiempo_permanencia');

        $visitas->user_register=auth()->user()->name;
        $visitas->save();
        
        return redirect()->route('visitas.create')->with('guardo','si');


    }

    /**
     * Display the specified resource.
     */
    public function show(visitas $visitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visitas $visitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, visitas $visitas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(visitas $visitas)
    {
        //
    }
}
