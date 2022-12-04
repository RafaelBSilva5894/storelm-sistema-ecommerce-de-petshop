<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Carrinho;
use App\Models\ItemPedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = Carrinho::where('user_id', Auth::id())->get();
        foreach ($old_cartitems as $item) {
            if (!Produto::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()) {
                $removeItem = Carrinho::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartitems = Carrinho::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cartitems'));
    }

    public function facaencomenda(Request $request)
    {
        $pedido = new Pedido();
        $pedido->user_id = Auth::id();
        $pedido->fname = $request->input('fname');
        $pedido->lname = $request->input('lname');
        $pedido->email = $request->input('email');
        $pedido->cpf = $request->input('cpf');
        $pedido->phone = $request->input('phone');
        $pedido->address = $request->input('address');
        $pedido->numero = $request->input('numero');
        $pedido->bairro = $request->input('bairro');
        $pedido->city = $request->input('city');
        $pedido->state = $request->input('state');
        $pedido->cep = $request->input('cep');

        $pedido->payment_mode = $request->input('payment_mode');
        $pedido->payment_id = $request->input('payment_id');

        //Para calcular o preço total
        $total = 0;
        $cartitems_total = Carrinho::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            $total += $prod->produtos->selling_price * $prod->prod_qty;
        }

        $pedido->total_price = $total;

        $pedido->tracking_no = 'storelm' . rand(1111, 9999);
        $pedido->save();

        $cartitems = Carrinho::where('user_id', Auth::id())->get();
        foreach ($cartitems as $item) {
            ItemPedido::create([
                'pedido_id' => $pedido->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->produtos->selling_price,
            ]);

            $prod = Produto::where('id', $item->prod_id)->first();
            $prod->qty =  $prod->qty - $item->prod_qty;
            $prod->update();
        }

        if (Auth::user()->address == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->email = $request->input('email');
            $user->cpf = $request->input('cpf');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->numero = $request->input('numero');
            $user->bairro = $request->input('bairro');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->cep = $request->input('cep');
            $user->update();
        }

        $cartitems = Carrinho::where('user_id', Auth::id())->get();
        Carrinho::destroy($cartitems);

        if ($request->input('payment_mode') == "Pago por Paypal") {
            return response()->json(['status' => "Pedido Feito com Sucesso!"]);
        }
        return redirect('/')->with('status', "Pedido Feito com Sucesso!");
    }
}
