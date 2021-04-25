<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestionPedidos;
use App\Models\GestionPedidosLinea;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
                    ->join('users','gestion_pedidos.user_id','=','users.id')
                    ->join('gestion_pedidos_lineas','gestion_pedidos_lineas.idPedido','=','gestion_pedidos.id')
                    ->join('pizzas','gestion_pedidos_lineas.idPizza','=','pizzas.id')
                    ->select('gestion_pedidos.id','users.name','pizzas.name as namepizza','gestion_pedidos_lineas.cantidad','gestion_pedidos.created_at')
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
            try {
                DB::beginTransaction();
                $pedidos = new GestionPedidos();
                $pedidos->user_id = $idusuario;
                $pedidos->save();
                $idpedido = $pedidos->id;
               
                
               foreach($request->all() as $linea){
                    $pedidolinea = new GestionPedidosLinea();
                    $pedidolinea->idPedido = $idpedido;
                    $pedidolinea->idPizza = $linea['id'];
                    $pedidolinea->cantidad = $linea['cantidad'];
                    $pedidolinea->precio = $linea['precio'];
                    $pedidolinea->save();
                }    // database queries here
                DB::commit();
                return 'OK';
            } catch (\PDOException $e) {
                // Woopsy
                DB::rollBack();
                return 'ERROR';
            }
            
        }
 
  
    }
}
