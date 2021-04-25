<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredientes;

class GestionIngredientesController extends Controller
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
        return Ingredientes::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredientes = new Ingredientes();
        $ingredientes->name = $request->name;
        $ingredientes->save();
        return $ingredientes;
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
       $ingredientes = Ingredientes::find($id);
       $ingredientes->name = $request->name;
       $ingredientes->save();
       return $ingredientes;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $ingredientes = Ingredientes::find($id);
       $ingredientes->delete();
       return '';
    }

}
