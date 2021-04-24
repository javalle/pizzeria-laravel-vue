<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestionPedidosLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestion_pedidos_lineas', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('idPedido')->constrained('gestion_pedidos');
            $table->integer('idPedido');
            //$table->foreignId('idPizza')->constrained('pizzas');
            $table->integer('idPizza');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gestion_pedidos_lineas');
    }
}
