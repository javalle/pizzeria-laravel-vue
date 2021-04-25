@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">PIZZAS</a></li>
    <li><a data-toggle="tab" href="#menu1">INGREDIENTES</a></li>
    <li><a data-toggle="tab" href="#menu2">PEDIDOS</a></li>
    </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
          <div Class="col-md-8">
            <listadogestionpizza-component ></listadogestionpizza-component>
          </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <div Class="col-md-8">
        <listadogestioningredientes-component></listadogestioningredientes-component>
      </div>
      
    </div>
    <div id="menu2" class="tab-pane fade">
    <div Class="col-md-8">
    <lisstadogestionpedido-component></lisstadogestionpedido-component>
          </div>
      
    </div>
  </div>


  </div>
</div>
@endsection
