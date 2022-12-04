<?php

namespace App\Models;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemPedido extends Model
{
    use HasFactory;
    protected $table = 'itens_pedido';
    protected $fillable = [
        'pedido_id',
        'prod_id',
        'qty',
        'price',
    ];

    public function produtos(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'prod_id', 'id');
    }
}
