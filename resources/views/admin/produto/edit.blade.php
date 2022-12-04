@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Adicionar Produtos</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('update-produto/' . $produto->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Categoria</label>
                        <select class="form-select">
                            <option value="">{{ $produto->category->name }}</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" value="{{ $produto->name }}" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" value="{{ $produto->slug }}" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Pequena Descrição</label>
                        <textarea name="small_description" rows="3" class="form-control">{{ $produto->small_description }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Descrição</label>
                        <textarea name="description" rows="3" class="form-control">{{ $produto->description }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Preço original</label>
                        <input type="number" class="form-control" value="{{ $produto->original_price }}"
                            name="original_price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Preço de venda</label>
                        <input type="number" class="form-control" value="{{ $produto->selling_price }}"
                            name="selling_price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Quantidade</label>
                        <input type="number" class="form-control" value="{{ $produto->qty }}" name="qty">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Imposto</label>
                        <input type="number" class="form-control" value="{{ $produto->tax }}" name="tax">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" {{ $produto->status == '1' ? 'checked' : '' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Tendência</label>
                        <input type="checkbox" {{ $produto->trending == '1' ? 'checked' : '' }} name="trending">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Título</label>
                        <input type="text" class="form-control" value="{{ $produto->meta_title }}" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control">{{ $produto->meta_keywords }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Descrição</label>
                        <textarea name="meta_description" rows="3" class="form-control">{{ $produto->meta_description }}</textarea>
                    </div>
                    @if ($produto->image)
                        <img src="{{ asset('assets/uploads/produto/' . $produto->image) }}" alt="">
                    @endif
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
