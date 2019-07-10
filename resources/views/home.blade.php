@extends('layouts.app')

@section('title', 'App Shop | Dashboard')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title text-center">Dashboard</h2>
                <div class="panel-body">

                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif

                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                        <li class="active">
                            <a href="#dashboard" role="tab" data-toggle="tab">
                                <i class="material-icons">dashboard</i>
                                Carrito de compras
                            </a>
                        </li>
                        <li>
                            <a href="#tasks" role="tab" data-toggle="tab">
                                <i class="material-icons">list</i>
                                Pedidos realizados
                            </a>
                        </li>
                    </ul>

                    <hr>
                    <p>{{ auth()->user()->cart->details->count() }} productos en tu carrito de compras.</p>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->cart->details as $detail)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ $detail->product->featured }}" alt="" height="50px">
                                    </td>
                                    <td>
                                        <a href="{{ url('/products/'.$detail->product->id) }}" target="_blank">{{ $detail->product->name }}</a>
                                    </td>
                                    <td>&dollar;  {{ $detail->product->price }} </td>
                                    <td> {{ $detail->quantity }} </td>
                                    <td>&dollar; {{ $detail->quantity * $detail->product->price }} </td>
                                    <td class="td-actions">
                                        <form method="post" action="{{ url('/cart') }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                            
                                            <a href="{{ url('/products/'.$detail->product->id) }}" target="_blank" rel="tooltip" title="Ver Producto" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-info"></i>
                                            </a>
                                            <button type="submit" rel="tooltip" title="Eliminar Producto del carrito" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>                                            
                                        </form>
                                    </td>
                                </tr>                           
                            @endforeach
                        </tbody>
                    </table>

                    <hr>
                    <p class="text-center">
                        <strong>Total a pagar:</strong> $ {{ auth()->user()->cart->total }}
                    </p>
                    <hr>                    

                    <form method="post" action="{{ url('/order') }}">
                        {{ csrf_field() }}
                        
                        <div class="text-center">
                            <button class="btn btn-primary btn-round">
                                <i class="material-icons">done</i> Realizar pedido
                            </button>                        
                        </div>                        
                    </form>

                </div>
        </div>

    </div>

</div>

@include('includes.footer');
@endsection

