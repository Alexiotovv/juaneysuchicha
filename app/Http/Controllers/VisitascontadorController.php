<?php

namespace App\Http\Controllers;

use App\Models\visitascontador;
use Illuminate\Http\Request;

class VisitascontadorController extends Controller
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
        $cant=visitascontador::count();
        return view('visitas.create_visitasv2',['cant'=>$cant]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        if (request('inlineRadioOptions')=='HOMBRE') { $genero='HOMBRE';
        }else{$genero='MUJER';}

        $visitas = new visitascontador();
        $visitas->cantidad=request('cantidad');
        $visitas->sexo=$genero;
        $visitas->origen=request('origen');
        $visitas->etapa_vida=request('etapa_vida');
        $visitas->fecha_reg=request('fecha_reg');
        $visitas->hora_reg=request('hora_reg');
        $visitas->user_id=auth()->user()->id;
        $visitas->save();

        $cant=visitascontador::count();
       
        return response()->json(['cant'=>$cant]);
    }

    /**
     * Display the specified resource.
     */
    public function show(visitascontador $visitascontador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visitascontador $visitascontador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, visitascontador $visitascontador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(visitascontador $visitascontador)
    {
        //
    }
}
