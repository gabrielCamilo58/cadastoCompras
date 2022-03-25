@extends('pages.layout')

@section('navegacao')
<div class="d-flex justify-content-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index_cliente')}}">Clientes</a></li>
        <li class="breadcrumb-item active"><a href="{{route('index_produto')}}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{route('index_pedido')}}">Pedidos</a></li>
    </ol>
    
    <h1>Detalhes do pedido n°: {{$pedido->numero}}</h1>
</div>
@endsection

@section('conteudo')

    <h3>Detalhes do pedido n°: {{$pedido->numero}}</h3>

    <ul>
        <li><strong>Total do pedido R$</strong> {{$pedido->total}}</li>
        <li><strong>Data em que foi feito: </strong> {{$pedido->data}}</li>
        <li><strong>Status: </strong>{{$pedido->status}}</li>
    </ul>
        <h3>Dados do Produto:</h1>
    <ul>
        <li><strong>Nome do produto: </strong>{{$produto->name}}</li>
        <li><strong>Preço do produto: </strong>{{$produto->price}}</li>
    </ul>

        <h3>Dados do cliente:</h1>
    <ul>
        <li><strong>Nome do cliente: </strong>{{$cliente->name}}</li>
        <li><strong>Email: </strong>{{$cliente->email}}</li>
        <li><strong>CPF: </strong>{{$cliente->cpf}}</li>
    </ul>
        
@endsection