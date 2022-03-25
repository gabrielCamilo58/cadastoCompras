<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    private $produto;
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }
    public function index(Request $request)
    {
        $produtos = $this->produto->orderBy('name', 'ASC')->paginate(20);

        if($request->select == 'preco'){
            $produtos = $this->produto->orderBy('price', 'ASC')->paginate(20);
        }

        return view('pages.produtos.index', compact('produtos'));
    }
    public function create()
    {
        return view('pages.produtos.create');
    }
    public function store(StoreUpdateProduto $request)
    {
        
        $this->produto->create($request->all());

        return redirect()->route('index_produto');
    }
    public function edit($id)
    {
        if(!$produto = $this->produto->find($id)) return redirect()->back();
        
        return view('pages.produtos.edit', compact('produto'));
    }

    public function update(StoreUpdateProduto $request ,$id)
    {
        if(!$produto = $this->produto->find($id)) return redirect()->back();

        $produto->update($request->all());

        return redirect()->route('index_produto');
    }
    public function delete($id)
    {
        if(!$produto = $this->produto->find($id)) return redirect()->back();

        $produto->delete();

        return redirect()->route('index_produto');
    }
    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $produtos = $this->produto->where('name', 'LIKE', "%{$filtro}%")->paginate(20);
        
        return view('pages.produtos.index', compact('produtos', 'filtro'));

    }
}
