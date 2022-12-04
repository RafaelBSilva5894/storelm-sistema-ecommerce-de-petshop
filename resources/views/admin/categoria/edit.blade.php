@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Editar/Atualizar Categoria</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('update-categoria/' . $categoria->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Nome</label>
                        <input type="text" value="{{ $categoria->name }}" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" value="{{ $categoria->slug }}" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Descrição</label>
                        <textarea name="description" rows="3" class="form-control"> {{ $categoria->description }} </textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" {{ $categoria->status == '1' ? 'checked' : '' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox" {{ $categoria->popular == '1' ? 'checked' : '' }} name="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Título</label>
                        <input type="text" value="{{ $categoria->meta_title }}" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control"> {{ $categoria->meta_keywords }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Descrição</label>
                        <textarea name="meta_description" rows="3" class="form-control">{{ $categoria->meta_descrip }}</textarea>
                    </div>
                    @if ($categoria->image)
                        <img src="{{ asset('assets/uploads/categoria/' . $categoria->image) }}" alt="categoria image">
                    @endif
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
