<?php

use App\Models\Carrinho;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\AvaliacaoController;
use App\Http\Controllers\Frontend\CarrinhoController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ComentarioController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//  return view('welcome');});

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('categoria', [FrontendController::class, 'categoria']);
Route::get('ver-categoria/{slug}', [FrontendController::class, 'vercategoria']);
Route::get('categoria/{cate_slug}/{prod_slug}', [FrontendController::class, 'verproduto']);

Route::get('lista-produto', [FrontendController::class, 'listaprodutoAjax']);
Route::post('pesquisarproduto', [FrontendController::class, 'pesquisarProduto']);

Auth::routes();

Route::get('carregar-produtos-carrinho', [CarrinhoController::class, 'carrinhocount']);
Route::get('carregar-produtos-listadesejos', [WishlistController::class, 'listadesejoscount']);


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('adicionar-ao-carrinho', [CarrinhoController::class, 'addProduto']);
Route::post('delete-cart-item', [CarrinhoController::class, 'deleteproduto']);
Route::post('atualizar-carrinho', [CarrinhoController::class, 'atualizarcarrinho']);

Route::post('adicionar-a-listadedesejos', [WishlistController::class, 'add']);
Route::post('delete-item-listadesejos', [WishlistController::class, 'deleteitem']);

Route::middleware(['auth'])->group(function () {
    Route::get('carrinho', [CarrinhoController::class, 'vercarrinho']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('faca-a-encomenda', [CheckoutController::class, 'facaencomenda']);

    Route::get('meus-pedidos', [UserController::class, 'index']);
    Route::get('ver-pedido/{id}', [UserController::class, 'view']);

    Route::post('adicionar-avaliacao', [AvaliacaoController::class, 'add']);

    Route::get('add-comentario/{produto_slug}/usercomentario', [ReviewController::class, 'add']);
    Route::post('add-comentario', [ReviewController::class, 'create']);
    Route::get('edit-review/{produto_slug}/usercomentario', [ReviewController::class, 'edit']);
    Route::put('atualizar-comentario', [ReviewController::class, 'update']);

    Route::get('lista-desejos', [WishlistController::class, 'index']);
});


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('categorias', 'Admin\CategoriaController@index');
    Route::get('add-categoria', 'Admin\CategoriaController@add');
    Route::post('insert-categoria', 'Admin\CategoriaController@insert');
    Route::get('edit-categoria/{id}', [CategoriaController::class, 'edit']);
    Route::put('update-categoria/{id}', [CategoriaController::class, 'update']);
    Route::get('delete-categoria/{id}', [CategoriaController::class, 'destroy']);

    Route::get('produtos', [ProdutoController::class, 'index']);
    Route::get('add-produto', [ProdutoController::class, 'add']);
    Route::post('insert-produto', [ProdutoController::class, 'insert']);

    Route::get('edit-produto/{id}', [ProdutoController::class, 'edit']);
    Route::put('update-produto/{id}', [ProdutoController::class, 'update']);
    Route::get('delete-produto/{id}', [ProdutoController::class, 'destroy']);

    Route::get('pedidos', [PedidoController::class, 'index']);
    Route::get('admin/ver-pedido/{id}', [PedidoController::class, 'view']);
    Route::put('atualizar-pedido/{id}', [PedidoController::class, 'atualizarpedido']);

    Route::get('historico-pedido', [PedidoController::class, 'historicopedido']);

    Route::get('users', [DashboardController::class, 'users']);
    Route::get('ver-usuario/{id}', [DashboardController::class, 'verusuario']);
});
