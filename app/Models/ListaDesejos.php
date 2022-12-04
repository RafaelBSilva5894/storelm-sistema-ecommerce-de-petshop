<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaDesejos extends Model
{
    use HasFactory;
    protected $table = 'lista_desejos';
    protected $fillable = [
        'user_id',
        'prod_id',
    ];

    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'prod_id', 'id');
    }
}
