<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Produto;

class DashboardController extends Controller
{

    public function index()
    {
        $categoria = Categoria::count();
        $produto = Produto::count();
        $users = User::count();
        $total_pedidos = Pedido::count();
        $pedidos_concluidos = Pedido::where('status', '1')->count();
        $pedidos_pendentes = Pedido::where('status', '0')->count();
        return view('admin.index', compact('categoria','produto','users','total_pedidos','pedidos_concluidos','pedidos_pendentes'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function verusuario($id)
    {
        $users = User::find($id);
        return view('admin.users.view', compact('users'));
    }
}
