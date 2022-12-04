<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = Categoria::all();
        return view('admin.categoria.index', compact('categoria'));
    }

    public function add()
    {
        return view('admin.categoria.add');
    }

    public function insert(Request $request)
    {
        $categoria = new Categoria();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/categoria/', $filename);
            $categoria->image = $filename;
        }
        $categoria->name = $request->input('name');
        $categoria->slug = $request->input('slug');
        $categoria->description = $request->input('description');
        $categoria->status = $request->input('status') == TRUE ? '1' : '0';
        $categoria->popular = $request->input('popular') == TRUE ? '1' : '0';
        $categoria->meta_title = $request->input('meta_title');
        $categoria->meta_keywords = $request->input('meta_keywords');
        $categoria->meta_descrip = $request->input('meta_description');
        $categoria->save();
        return redirect('/dashboard')->with('status', "Categoria adicionada com sucesso!");
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categoria.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/categoria/' . $categoria->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/categoria', $filename);
            $categoria->image = $filename;
        }
        $categoria->name = $request->input('name');
        $categoria->slug = $request->input('slug');
        $categoria->description = $request->input('description');
        $categoria->status = $request->input('status') == TRUE ? '1' : '0';
        $categoria->popular = $request->input('popular') == TRUE ? '1' : '0';
        $categoria->meta_title = $request->input('meta_title');
        $categoria->meta_keywords = $request->input('meta_keywords');
        $categoria->meta_descrip = $request->input('meta_description');
        $categoria->update();
        return redirect('dashboard')->with('status', "Atualização de categoria com sucesso!");
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        if ($categoria->image) {
            $path = 'assets/uploads/categoria/' . $categoria->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $categoria->delete();
        return redirect('categoria')->with('status', "Categoria excluída com sucesso!");
    }
}
