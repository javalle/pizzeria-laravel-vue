@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
      <listadopizza-component></listadopizza-component>
        
            <div class="card">
                <div class="card-header">{{ __('Pedidos') }}</div>

                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                

                    {{ __('You are logged in!Con componente' ) }}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
