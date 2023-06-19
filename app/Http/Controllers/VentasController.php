<?php

namespace App\Http\Controllers;

use App\Models\ventas;
use App\Models\productos;
use Illuminate\Http\Request;

class VentasController extends Controller
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
        $productos=productos::all();
        return view('ventas.create_ventas',compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj=new ventas();
        $obj->fecha=request('fecha');
        $obj->precio_venta=request('precio_venta');
        $obj->producto_id=request('producto');
        $obj->user_id=auth()->user()->id;
        $obj->user=auth()->user()->name;
        $obj->save();
        return redirect()->route('ventas.create')->with('guardo','si');

    }

    /**
     * Display the specified resource.
     */
    public function show(ventas $ventas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ventas $ventas)
    {
        //
    }
}
