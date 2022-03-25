<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    protected $fillable = ['clients_id', 'produtos_id', 'total', 'qtd', 'data', 'status', 'numero'];
    use HasFactory;

    public function cliente()
    {
        return $this->BelongsTo(Client::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
