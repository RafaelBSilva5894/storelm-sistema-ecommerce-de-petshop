<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($produto_slug)
    {
        $produto = Produto::where('slug', $produto_slug)->where('status', '0')->first();
        if ($produto) {
            $produto_id = $produto->id;
            $review= Comentario::where('user_id', Auth::id())->where('prod_id', $produto_id)->first();
            if ($review)
            {
                return view('frontend.comentarios.edit', compact('review'));
            }
            else
            {
                $compra_verificada = Pedido::where('pedidos.user_id', Auth::id())
                    ->join('itens_pedido', 'pedidos.id', 'itens_pedido.pedido_id')
                    ->where('itens_pedido.prod_id', $produto_id)->get();
                return view('frontend.comentarios.index', compact('produto', 'compra_verificada'));
            }
        }
        else
        {
            return redirect()->back()->with('status', "O link que você seguiu foi quebrado!");
        }
    }

    public function create(Request $request)
    {
        $produto_id = $request->input('produto_id');
        $produto = Produto::where('id', $produto_id)->where('status', '0')->first();
        if ($produto) {
            $user_review = $request->input('user_review');
            $new_review = Comentario::create([
                'user_id' => Auth::id(),
                'prod_id' => $produto_id,
                'user_review' => $user_review,
            ]);

            $categoria_slug = $produto->category->slug;
            $prod_slug = $produto->slug;
            if ($new_review) {
                return redirect('categoria/' . $categoria_slug . '/' . $prod_slug)->with('status', "Obrigado por escrever um comentário!");
            }
        } else {
            return redirect()->back()->with('status', "O link que você seguiu foi quebrado!");
        }
    }

    public function edit($produto_slug)
    {
        $produto = Produto::where('slug', $produto_slug)->where('status', '0')->first();
        if ($produto) {
            $produto_id = $produto->id;
            $review = Comentario::where('user_id', Auth::id())->where('prod_id', $produto_id)->first();
            if ($review) {
                return view('frontend.comentarios.edit', compact('review'));
            } else {
                return redirect()->back()->with('status', "O link que você seguiu foi quebrado!");
            }
        } else {
            return redirect()->back()->with('status', "O link que você seguiu foi quebrado!");
        }
    }

    public function update(Request $request)
    {
        $user_review = $request->input('user_review');
        if ($user_review != '') {
            $review_id = $request->input('review_id');
            $review = Comentario::where('id', $review_id)->where('user_id', Auth::id())->first();
            if ($review) {
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('categoria/' . $review->produto->category->slug . '/' . $review->produto->slug)->with('status', "Comentário atualizado com Sucesso!");
            } else {
                return redirect()->back()->with('status', "O link que você seguiu foi quebrado!");
            }
        } else {
            return redirect()->back()->with('status', "Você não pode enviar uma avaliação vazia!");
        }
    }
}
