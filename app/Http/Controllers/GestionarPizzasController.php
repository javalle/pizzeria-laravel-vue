<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizzas;

class GestionarPizzasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pizzas::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pizza = new Pizzas();
        $pizza->name = $request->name;
        $pizza->precio = $request->precio;
        $pizza->imagen = $request->imagen;
        $pizza->ingredientes = $request->ingredientes;
        $pizza->save();
        return $pizza;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $pizzas = Pizzas::find($id);
       $pizzas->name = $request->name;
       $pizzas->precio = $request->precio;
       $pizzas->imagen = $request->imagen;
       $pizzas->ingredientes = $request->ingredientes;
       $pizzas->save();
       return $pizzas;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $pizzas = Pizzas::find($id);
       $pizzas->delete();
       return '';
    }
}
