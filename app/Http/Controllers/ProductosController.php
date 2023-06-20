<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;
use DB;

class ProductosController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj=new productos();
        $obj->producto=request('nombre_producto');
        $obj->save();
        return response()->json(['guardo'=>'ok']);
    }

    /**
     * Display the specified resource.
     */
    public function show(productos $productos)
    {
        $productos=DB::table('productos')
        ->select('productos.producto','productos.id')
        ->get();
        return response()->json($productos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productos $productos)
    {
        //
    }
}
