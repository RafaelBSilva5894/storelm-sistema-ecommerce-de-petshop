<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    public function add(Request $request)
    {
        $estrelas_avaliadas = $request->input('product_rating');
        $produto_id = $request->input('produto_id');

        $produto_check = Produto::where('id', $produto_id)->where('status', '0')->first();
        if ($produto_check) {
            $compra_verificada = Pedido::where('pedidos.user_id', Auth::id())
                ->join('itens_pedido', 'pedidos.id', 'itens_pedido.pedido_id')
                ->where('itens_pedido.prod_id', $produto_id)->get();

            if ($compra_verificada->count() > 0) {
                $avaliacao_existente = Avaliacao::where('user_id', Auth::id())->where('prod_id', $produto_id)->first();
                if ($avaliacao_existente)
                {
                    $avaliacao_existente->estrelas_avaliadas = $estrelas_avaliadas;
                    $avaliacao_existente->update();
                } else {
                    Avaliacao::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $produto_id,
                        'estrelas_avaliadas' => $estrelas_avaliadas
                    ]);
                }
                return redirect()->back()->with('status', "Obrigado por avaliar este produto!");
            } else {
                return redirect()->back()->with('status', "Você não pode avaliar um produto sem comprá-lo!");
            }
        } else {
            return redirect()->back()->with('status', "O link que você seguiu foi quebrado!");
        }
    }
}
