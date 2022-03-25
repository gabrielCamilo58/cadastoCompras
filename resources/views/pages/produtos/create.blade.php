@extends('pages.layout')

@section('navegacao')
<h1>Cadastrar novo Produto</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{route('index_produto')}}">Produtos</a></li>
    <li class="breadcrumb-item active"> <a href="#">Pedidos</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('index_cliente')}}">Cliente</a></li>
</ol>
@endsection

@section('conteudo')
    <form action="{{route('store_produto')}}" method="POST">
       @include('pages.produtos._partials.form')
    </form>
@endsection