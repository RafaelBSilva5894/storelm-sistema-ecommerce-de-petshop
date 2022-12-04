<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProdutoController extends Controller
{
    public function index()
    {
        $produto = Produto::all();
        return view('admin.produto.index', compact('produto'));
    }

    public function add()
    {
        $categoria = Categoria::all();
        return view('admin.produto.add', compact('categoria'));
    }

    public function insert(Request $request)
    {
        $produto = new Produto();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/produto/', $filename);
            $produto->image = $filename;
        }
        $produto->cate_id = $request->input('cate_id');
        $produto->name = $request->input('name');
        $produto->slug = $request->input('slug');
        $produto->small_description = $request->input('small_description');
        $produto->description = $request->input('description');
        $produto->original_price = $request->input('original_price');
        $produto->selling_price = $request->input('selling_price');
        $produto->qty = $request->input('qty');
        $produto->tax = $request->input('tax');
        $produto->status = $request->input('status') == TRUE ? '1' : '0';
        $produto->trending = $request->input('trending') == TRUE ? '1' : '0';
        $produto->meta_title = $request->input('meta_title');
        $produto->meta_keywords = $request->input('meta_keywords');
        $produto->meta_description = $request->input('meta_description');
        $produto->save();
        return redirect('produtos')->with('status', "Produto adicionado com sucesso!");
    }

    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('admin.produto.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/produto/' . $produto->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/produto/', $filename);
            $produto->image = $filename;
        }
        $produto->name = $request->input('name');
        $produto->slug = $request->input('slug');
        $produto->small_description = $request->input('small_description');
        $produto->description = $request->input('description');
        $produto->original_price = $request->input('original_price');
        $produto->selling_price = $request->input('selling_price');
        $produto->qty = $request->input('qty');
        $produto->tax = $request->input('tax');
        $produto->status = $request->input('status') == TRUE ? '1' : '0';
        $produto->trending = $request->input('trending') == TRUE ? '1' : '0';
        $produto->meta_title = $request->input('meta_title');
        $produto->meta_keywords = $request->input('meta_keywords');
        $produto->meta_description = $request->input('meta_description');
        $produto->update();
        return redirect('produtos')->with('status', "Produto atualizado com sucesso!");
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        $path = 'assets/uploads/produto/' . $produto->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $produto->delete();
        return redirect('produtos')->with('status', "Produto apagado com sucesso!");
    }
}
