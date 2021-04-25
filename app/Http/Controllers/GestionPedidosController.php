<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestionPedidos;
use App\Models\GestionPedidosLinea;
use App\Models\User;
use App\Http\Controllers\Auth;

class GestionPedidosController extends Controller
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
       
        $pedidos = DB::table('gestion_pedidos')
                    ->join('users','gestion_pedidos.users_id','=','users.id')
                    ->join('gestion_pedidos_lineas','gestion_pedidos_lineas.idPedido','=','gestion_pedidos.id')
                    ->join('gestion_pedidos_lineas','gestion_pedidos_lineas.idPizza','=','pizzas.id')
                    ->select('gestion_pedidos.id','user.name','pizza.name','gestion_pedidos_lineas.cantidad','gestion_pedidos.create_at')
                    ->get();
        return $pedidos;
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idusuario = auth()->user()->id;
        if($idusuario){
            $pedidos = new GestionPedidos();
            $pedidos->user_id = $idusuario;
            $pedidos->save();
            $idpedido = $pedidos->id;
            $arrayobjeto = json_decode($request);
            foreach($arrayobjeto as $linea){
                $pedidolinea = new GestionPedidosLinea();
                $pedidolinea->idPedido = $idpedido;
                $pedidolinea->idPizza = $linea['id'];
                $pedidolinea->cantidad = $linea['cantidad'];
                $pedidolinea->precio = $linea['precio'];
                $pedidolinea->save();
            }
        }
        return '';
  
    }
}
