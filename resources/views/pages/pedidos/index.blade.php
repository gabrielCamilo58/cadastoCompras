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
            <a class="nav-link" href="{{route('index_produto')}}">Produto</a>
          </li>

          @if(!Request::is('pedido'))
          <li class="nav-item">
            <a href="{{route('index_pedido')}}" class="nav-link">Todos os pedidos</a>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{route('index_pedido', 'pagos')}}" class="nav-link">Pedidos Pagos</a>
          </li>
          <li class="nav-item">
            <a href="{{route('index_pedido', 'cancelados')}}" class="nav-link">Pedidos Cancelados</a>
          </li>
        </ul>
        <form action="{{route('search_pedido')}}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filtro" placeholder="Pesquisar por pedido n°" class="form-control">
            <button class="btn btn-outline-success" >Pesquisar</button>
        </form>
        <form action="{{route('index_pedido')}}" class="form form-inline ml-2" method="POST">
            @csrf
            <select class="form-select form-control" aria-label="Default select example" name="select">
                <option selected>Ordenar pedido por</option>
                <option  value="id">Mais recente</option>
                <option  value="numero">Numero do pedido</option>
                <option  value="data">data do pedido</option>
              </select>
              <button class="btn btn-outline-success" >Ordenar</button>
            </form>
      </div>
    </div>
  </nav>


<h1>Pedidos</h1>

@endsection

@section('conteudo')
    <table class="table table-condesed">
        <thead>
            <tr>
                <th>Pedido n°</th>
                <th>Total do pedido</th>
                <th>Data do Pedido</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td>{{$pedido->numero}}</td>
                <td>{{$pedido->total}}</td>
                <td>{{ date( 'd/m/Y' , strtotime($pedido->data))}}</td>
                <td>{{$pedido->status}}</td>
                <td>
                    <form action="{{route('delete_pedido', $pedido->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a href="{{route('show_pedido', $pedido->id)}}" class="btn btn-info">ver</a>

                        @if($pedido->status !== 'Cancelado')
                            @if($pedido->status !== 'Pago')
                                <a href="{{route('update_pedido', [$pedido->id, 'Pago'])}}"  class="btn btn-info">Marcar como pago</a>
                            @endif
                            <a href="{{route('update_pedido', [$pedido->id, 'Cancelado'])}}"  class="btn btn-info">Cancelar Pedido</a>
                        @endif

                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>  
            @endforeach
        </tbody>
    </table>
    <div class="card-footer">
        @if (isset($filtro))
            {!! $pedidos->appends($filtro)->links() !!}
        @else
            {!! $pedidos->links() !!}
        @endif
    </div>
@endsection