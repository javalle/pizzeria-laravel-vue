<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pizzas;

class ListarPizzaController extends Controller
{
    public function getLista(){
        $listado =  Pizzas::get();
        return $listado;
    }
}
