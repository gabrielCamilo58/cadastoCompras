@extends('pages.layout')

@section('navegacao')
<h1>Editar dados do produto: {{$produto->name}}</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{route('index_produto')}}">Produtos</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('index_pedido')}}">Pedidos</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('index_cliente')}}">Clientes</a></li>
</ol>
@endsection

@section('conteudo')
    <form action="{{route('update_produto', $produto->id)}}" method="POST">
       @include('pages.produtos._partials.form')
    </form>
@endsection