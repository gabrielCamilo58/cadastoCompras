<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCliente;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $cliente;
    public function __construct(Client $cliente)
    {
        $this->cliente = $cliente;
    }
    public function index(Request $request)
    {
        $clientes = $this->cliente->orderBy('name', 'ASC')->paginate(20);

        if($request->select === 'email') {
            $clientes = $this->cliente->orderBy('email', 'ASC')->paginate(20);
        }
        
        return view('pages.cliente.index', compact('clientes')); //lembrar de mudar a primeira rota
    }
    public function create()
    {
        return view('pages.cliente.create');
    }

    public function store(StoreUpdateCliente $request)
    {
        
        $this->cliente->create($request->all());

        return redirect()->route('index_cliente');
    }

    public function edit($id)
    {
        
        if(!$cliente = $this->cliente->find($id)) return redirect()->back();

        return view('pages.cliente.edit', compact('cliente'));
    }

    public function update(StoreUpdateCliente $request, $id)
    {
        if(!$cliente = $this->cliente->find($id)) return redirect()->back();

        $cliente->update($request->all());

        return redirect()->route('index_cliente');
    }

    public function delete($id)
    {
        if(!$cliente = $this->cliente->find($id)) return redirect()->back();

        $cliente->delete();

        return redirect()->route('index_cliente');
    }
    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $clientes = $this->cliente->where('name', 'LIKE', "%{$filtro}%")->paginate(20);
        
        return view('pages.cliente.index', compact('clientes', 'filtro'));

    }
}
