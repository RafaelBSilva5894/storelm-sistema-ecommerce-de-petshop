<?php

namespace App\Models;

use App\Models\ItemPedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $fillable = [
        'user_id',
        'total_price',
        'fname',
        'lname',
        'email',
        'cpf',
        'phone',
        'address',
        'numero',
        'bairro',
        'city',
        'state',
        'cep',
        'payment_mode',
        'payment_id',
        'status',
        'message',
        'tracking_no',
    ];

    public function itenspedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
