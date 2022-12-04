<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::id())->get();
        return view('frontend.pedidos.index', compact('pedidos'));
    }

    public function view($id)
    {
        $pedidos = Pedido::where('id', $id)->where('user_id', Auth::id())->first();
        return view('frontend.pedidos.view', compact('pedidos'));
    }
}
