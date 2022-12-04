@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Pagina de Produtos</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Categoria</th>
                        <th>Nome</th>
                        <th>Preço de Venda</th>
                        <th>Imagem</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produto as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->selling_price }}</td>
                            <td>
                                <img src="{{ asset('assets/uploads/produto/' . $item->image) }}" class="cate-image"
                                    alt="Imagem aqui">
                            </td>
                            <td>
                                <a href="{{ url('edit-produto/' . $item->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <a href="{{ url('delete-produto/' . $item->id) }}" class="btn btn-danger btn-sm">Deletar</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
