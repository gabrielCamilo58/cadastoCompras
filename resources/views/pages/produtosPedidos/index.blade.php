@extends('pages.layout')

@section('navegacao')
<div class="d-flex justify-content-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('index_produto')}}">Produtos</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('index_cliente')}}">clientes</a></li>
    </ol>
    <h1>Realizar pedido</h1>
</div>
@endsection

@section('conteudo')
    <table class="table table-condesed">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Codigo de Barras</th>
                <th>Quantidade</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->name}}</td>
                    <td>{{$produto->price}}</td>
                    <td>{{$produto->codBarras}}</td>
                    <td>
                        <form action="{{route('store_pedido', [$cliente->id, $produto->id])}}" method="POST">
                            @csrf
                            <input type="number" min="0" oninput="this.value = Math.abs(this.value)" name="qtd" placeholder="Quantidade">
                            <button type="submit"  class="btn btn-success">Comprar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    
@endsection