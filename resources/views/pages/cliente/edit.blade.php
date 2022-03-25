@extends('pages.layout')

@section('navegacao')
<h1>Editar dados do cliente: {{$cliente->name}}</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{route('index_produto')}}">Produtos</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('index_pedido')}}">Pedidos</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('index_cliente')}}">Clientes</a></li>
</ol>
@endsection

@section('conteudo')
    <form action="{{route('update_cliente', $cliente->id)}}" method="POST">
       @include('pages.cliente._partials.form')
    </form>
@endsection