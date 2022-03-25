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
            <a class="nav-link active" aria-current="page" href="{{route('index_cliente')}}">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('index_pedido')}}">Pedido</a>
          </li>
        </ul>
        <form action="{{route('search_produto')}}" class="d-flex" method="POST">
            @csrf
            <input type="text" name="filtro" placeholder="Pesquisar por produto:" class="form-control">
            <button class="btn btn-outline-success" >Pesquisar</button>
        </form>
        <form action="{{route('index_produto')}}" class="form form-inline ml-2" method="POST">
            @csrf
            <select class="form-select form-control" aria-label="Default select example" name="select">
                <option selected>Ordenar produto por</option>
                <option  value="name">Nome</option>
                <option  value="preco">Preço</option>
              </select>
              <button class="btn btn-outline-success" >Ordenar</button>
        </form>
        <a href="{{route('create_produto')}}" class="btn btn-dark ml-2">Adicionar Produto</a>
      </div>
    </div>
  </nav>


<h1>Produtos</h1>

@endsection

@section('conteudo')

<table class="table table-condensed">
    <thead>
        <tr>
            <th>Nome:</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th style="width: 200px">Ações</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($produtos as $produto)
            <tr>
                <td>{{$produto->name}}</td>
                <td>{{$produto->price}}</td>
                <td>{{$produto->descricao}}</td>
                <td>
                    <form action="{{route('delete_produto', $produto->id)}}" method="POST"  onsubmit=" return confirm('tem certeza que deseja deletar o produto: {{$produto->name}}') ">
                        @csrf
                        @method('DELETE')

                        <a href="{{route('edit_produto', $produto->id)}}" class="btn btn-info">Editar</a>

                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer">
    @if (isset($filtro))
        {!! $produtos->appends($filtro)->links() !!}
    @else
        {!! $produtos->links() !!}
    @endif
</div>
@endsection