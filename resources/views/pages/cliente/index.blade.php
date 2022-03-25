@extends('pages.layout')

@section('navegacao')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('index_produto')}}">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('index_pedido')}}">Pedido</a>
          </li>
        </ul>
        <form action="{{route('search_cliente')}}" method="POST" class="d-flex">
            @csrf
            <input type="text" name="filtro" placeholder="Pesquisar por cliente:" class="form-control">
            <button class="btn btn-outline-success">Pesquisar</button>
        </form>
        <form action="{{route('index_cliente')}}" class="form form-inline ml-2" method="POST">
            @csrf
            <select class="form-select form-control" aria-label="Default select example" name="select">
                <option selected>Ordenar por</option>
                <option  value="name">Nome</option>
                <option  value="email">Email</option>
              </select>
              <button class="btn btn-outline-success">Ordenar</button>
            </form>
            <a href="{{route('create_cliente')}}" class="btn btn-dark ml-2">Adicionar Cliente</a>
      </div>
    </div>
  </nav>

        <h1>Clientes</h1> 
        
@endsection

@section('conteudo')
<table class="table table-condensed">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{$cliente->name}}</td>
            <td>{{$cliente->email}}</td>
            <td>{{$cliente->cpf}}</td>
            <td>
                <form action="{{route('delete_cliente', $cliente->id)}}" method="POST" onsubmit=" return confirm('tem certeza que deseja excluir o cliente {{$cliente->name}}?')">
                    @csrf
                    @method('DELETE')

                    <a href="{{route('show_clientePedido', $cliente->id)}}" class="btn btn-info">Ver Pedidos</a>
                    <a href="{{route('edit_cliente', $cliente->id)}}" class="btn btn-info">Editar</a>
                    <a href="{{route('create_pedido', $cliente->id)}}" class="btn btn-success">Realizar Pedido</a>

                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer">
    @if (isset($filtro))
        {!! $clientes->appends($filtro)->links() !!}
    @else
        {!! $clientes->links() !!}
    @endif
</div>
@endsection