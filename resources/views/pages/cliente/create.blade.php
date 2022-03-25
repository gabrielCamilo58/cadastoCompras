@extends('pages.layout')

@section('navegacao')
<h1>Cadastrar novo Cliente</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{route('index_produto')}}">Produtos</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('index_produto')}}">Pedidos</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('index_produto')}}">Cliente</a></li>
</ol>
@endsection

@section('conteudo')
    <form action="{{route('store_cliente')}}" method="POST">
       @include('pages.cliente._partials.form')
    </form>
@endsection