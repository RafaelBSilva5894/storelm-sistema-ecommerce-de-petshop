<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;
    protected $table = 'carrinhos';
    protected $fillable = [
        'user_id',
        'prod_id',
        'prod_qty',
    ];

    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'prod_id', 'id');
    }
}
