<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produto;
use App\Models\Avaliacao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $fillable = [
        'user_id',
        'prod_id',
        'user_review'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'prod_id', 'id');
    }
}
