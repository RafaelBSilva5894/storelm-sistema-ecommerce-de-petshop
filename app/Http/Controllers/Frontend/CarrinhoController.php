<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Carrinho;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{

    public function addProduto(Request $request)
    {
        $produto_id = $request->input('produto_id');
        $produto_qty = $request->input('produto_qty');

        if (Auth::check()) {
            $prod_check = Produto::where('id', $produto_id)->first();

            if ($prod_check) {
                if (Carrinho::where('prod_id', $produto_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . " já adicionado ao carrinho!"]);
                } else {
                    $cartItem = new Carrinho();
                    $cartItem->prod_id =  $produto_id;
                    $cartItem->user_id =  Auth::id();
                    $cartItem->prod_qty =  $produto_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name . " adicionado ao carrinho"]);
                }
            }
        } else {
            return response()->json(['status' =>  "Faça login para continuar!"]);
        }
    }

    public function vercarrinho()
    {
        $carrinhoItems = Carrinho::where('user_id', Auth::id())->get();
        return view('frontend.carrinho', compact('carrinhoItems'));
    }

    public function atualizarcarrinho(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $produto_qty = $request->input('prod_qty');

        if (Auth::check()) {
            if (Carrinho::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $carrinho = Carrinho::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $carrinho->prod_qty =  $produto_qty;
                $carrinho->update();
                return response()->json(['status' => "Atualização de quantidade"]);
            }
        }
    }

    public function deleteproduto(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (Carrinho::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Carrinho::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' =>  "Produto removido com sucesso!"]);
            }
        } else {
            return response()->json(['status' =>  "Faça login para continuar!"]);
        }
    }

    public function carrinhocount()
    {
        $carrinhocount = Carrinho::where('user_id', Auth::id())->count();
        return response()->json(['count' => $carrinhocount]);
    }
}
