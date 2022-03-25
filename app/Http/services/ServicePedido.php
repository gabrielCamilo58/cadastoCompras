<?php

namespace App\Http\services;

use App\Models\Client;
use App\Models\Pedido;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use Nette\Utils\Random;

class ServicePedido
{
    public function criarPedido($qtd, $idCliente, $produto, $date ): array
    {
        
        $data['numero'] = $this->criarNumeroPedido();
        
        $data['qtd'] = $qtd['qtd'];
        $data['data'] = $date;
        $preco = $produto->price;
        $data['total'] = $qtd['qtd'] * $preco;
        $data['produtos_id'] = $produto->id;
        $data['status'] = 'Em aberto';
        $data['clients_id'] = $idCliente;
    
        return $data;
    }

    private function criarNumeroPedido($num = 1): int
    {
      
        $data = date('Y-m-d');
        $pedidoData = DB::table('pedidos')->where('data', 'LIKE', "%{$data}%")->get();
        $pedidoNum = DB::table('pedidos')->where('numero', $num)->get();
        
        if((count($pedidoData) != false) && (count($pedidoNum) != false)){
            return $this->criarNumeroPedido($num += 1);
        }

        return $num;
    }

    public function ordenarPedidos($request = null)
    {

        if ($request->select == 'data'){
            return DB::table('pedidos')->orderBy('data', 'ASC')->paginate(20);
        }
        if($request->select == 'numero'){
            return DB::table('pedidos')->orderBy('numero', 'ASC')->paginate(20);
        }

        return DB::table('pedidos')->orderBy('id', 'DESC')->paginate(20);
    }

    public function filtrarStatus($status){

        if($status === 'pagos'){
            return DB::table('pedidos')->where('status', 'Pago')->paginate(20);
        }
    return DB::table('pedidos')->where('status', 'Cancelado')->paginate(20);
    }
    

}