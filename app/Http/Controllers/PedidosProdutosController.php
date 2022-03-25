<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidos;
use App\Http\services\ServicePedido;
use App\Models\Client;
use App\Models\Pedido;
use App\Models\Produto;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class PedidosProdutosController extends Controller
{
    private $produto, $cliente, $pedido, $emissao, $service;
    public function __construct(Pedido $pedido, Produto $produto, Client $cliente, ServicePedido $service)
    {
        $this->produto = $produto;
        $this->cliente = $cliente;
        $this->pedido = $pedido;
        $this->service = $service;
        $this->emissao = new DateTime();
    }
    public function index(Request $request, $status = null)
    {
        if(!$status){
            $pedidos = $this->service->ordenarPedidos($request);
        }else{
            $pedidos = $this->service->filtrarStatus($status);
        }

        return view('pages.pedidos.index', compact('pedidos'));
    }

    public function create($id)
    {
        $cliente = $this->cliente->find($id);
        $produtos = $this->produto->paginate();
        return view('pages.produtosPedidos.index', compact('produtos', 'cliente'));
    }

    public function store(Request $request, $idCliente, $idProduto)
    {
        if(!$produto = $this->produto->find($idProduto)) return redirect()->back();
        if(!$cliente = $this->cliente->find($idCliente)) return redirect()->back();
 
        $data = $this->service->criarPedido($request->only('qtd'), $idCliente, $produto, $this->emissao);

        
        $this->pedido->create($data);

        return redirect()->route('index_pedido');
    }

    public function  update($id, $idStatus)
    {
        if(!$pedido = $this->pedido->find($id)) return redirect()->back();


        if($idStatus === 'Pago') $pedido->status = 'Pago';

        if($idStatus === 'Cancelado') $pedido->status = $idStatus;
        $pedido->save();
    
        return redirect()->route('index_pedido');
    }

    public function delete($id)
    {
        if(!$pedido = $this->pedido->find($id)) return redirect()->back();

        $pedido->delete();

        return redirect()->route('index_pedido');
    }

    public function show($idPedido)
    {
        if(!$pedido = $this->pedido->find($idPedido)) return redirect()->back();
        if(!$cliente = $this->cliente->find($pedido->clients_id)) return redirect()->back();
        if(!$produto = $this->produto->find($pedido->produtos_id)) return redirect()->back();

        return view('pages.pedidos.show', compact('pedido', 'cliente', 'produto'));
    }

    public function produtosPedidos($id)
    {
        if(!$cliente = $this->cliente->find($id)) return redirect()->back();

        $pedidos = $this->pedido->where('clients_id', $id)->paginate();
        return view('pages.cliente.pedidos', compact('pedidos'));
    }

    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $pedidos = $this->pedido->where('numero', 'LIKE', "%{$filtro}%")->paginate(20);
        
        return view('pages.pedidos.index', compact('pedidos', 'filtro'));

    }
    
}
