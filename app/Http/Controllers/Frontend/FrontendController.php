<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Comentario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $feature_produtos = Produto::where('trending', '1')->take(15)->get();
        $trending_categoria = Categoria::where('popular', '1')->take(15)->get();
        return view('frontend.index', compact('feature_produtos', 'trending_categoria'));
    }

    public function categoria()
    {
        $categoria = Categoria::where('status', '0')->get();
        return view('frontend.category', compact('categoria'));
    }

    public function vercategoria($slug)
    {
        if (Categoria::where('slug', $slug)->exists()) {
            $categoria = Categoria::where('slug', $slug)->first();
            $produto = Produto::where('cate_id', $categoria->id)->where('status', '0')->get();
            return view('frontend.produto.index', compact('categoria', 'produto'));
        } else {
            return redirect('/')->with('status', "Slug não existe!");
        }
    }

    public function verproduto($cate_slug, $prod_slug)
    {
        if (Categoria::where('slug', $cate_slug)->exists()) {
            if (Produto::where('slug', $prod_slug)->exists()) {
                $produto = Produto::where('slug', $prod_slug)->first();
                $avaliacoes = Avaliacao::where('prod_id', $produto->id)->get();
                $avaliacoes_soma = Avaliacao::where('prod_id', $produto->id)->sum('estrelas_avaliadas');
                $avaliacao_user = Avaliacao::where('prod_id', $produto->id)->where('user_id', Auth::id())->first();
                $reviews = Comentario::where('prod_id', $produto->id)->get();
                if ($avaliacoes->count() > 0) {
                    $valor_avaliacao = $avaliacoes_soma / $avaliacoes->count();
                } else {
                    $valor_avaliacao = 0;
                }

                return view('frontend.produto.view', compact('produto', 'avaliacoes', 'reviews', 'valor_avaliacao', 'avaliacao_user'));
            } else {
                return redirect('/')->with('status', "O link está quebrado!");
            }
        } else {
            return redirect('/')->with('status', "Nenhuma categoria encontrada!");
        }
    }

    public function listaprodutoAjax()
    {
        $produto = Produto::select('name')->where('status', '0')->get();
        $data = [];

        foreach ($produto as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }

    public function pesquisarProduto(Request $request)
    {
        $produto_pesquisado = $request->produto_name;

        if ($produto_pesquisado != "") {
            $produto = Produto::where("name", "LIKE", "%$produto_pesquisado%")->first();
            if ($produto) {
                return redirect('categoria/' . $produto->category->slug . '/' . $produto->slug);
            } else {
                return redirect()->back()->with("status", "Nenhum produto corresponde a sua pesquisa!");
            }
        } else {
            return redirect()->back();
        }
    }
}
