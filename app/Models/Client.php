<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'cpf'];
    use HasFactory;

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
