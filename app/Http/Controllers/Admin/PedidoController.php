<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('status', '0')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function view($id)
    {
        $pedidos = Pedido::where('id', $id)->first();
        return view('admin.pedidos.view', compact('pedidos'));
    }

    public function atualizarpedido(Request $request, $id)
    {
        $pedidos = Pedido::find($id);
        $pedidos->status = $request->input('pedido_status');
        $pedidos->update();
        return redirect('pedidos')->with('status', "Pedido atualizado com Sucesso!");
    }

    public function historicopedido()
    {
        $pedidos = Pedido::where('status', '1')->get();
        return view('admin.pedidos.history', compact('pedidos'));
    }
}
