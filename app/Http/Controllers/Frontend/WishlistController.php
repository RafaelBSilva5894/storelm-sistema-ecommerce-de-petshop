<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ListaDesejos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $lista_desejos = ListaDesejos::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('lista_desejos'));
    }

    public function add(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('produto_id');
            if (Produto::find($prod_id)) {
                $desejo = new ListaDesejos();
                $desejo->prod_id = $prod_id;
                $desejo->user_id = Auth::id();
                $desejo->save();
                return response()->json(['status' => " Produto adicionado à sua lista de desejos!"]);
            } else {
                return response()->json(['status' => " Produto não existe!"]);
            }
        } else {
            return response()->json(['status' =>  "Faça login para continuar!"]);
        }
    }

    public function deleteitem(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (ListaDesejos::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $desejo = ListaDesejos::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $desejo->delete();
                return response()->json(['status' =>  "Item removido com sucesso!"]);
            }
        } else {
            return response()->json(['status' =>  "Faça login para continuar!"]);
        }
    }

    public function listadesejoscount()
    {
        $desejocount = ListaDesejos::where('user_id', Auth::id())->count();
        return response()->json(['count' => $desejocount]);
    }
}
