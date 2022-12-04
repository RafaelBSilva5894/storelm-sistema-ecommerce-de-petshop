@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Pagina de Categoria</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Imagem</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoria as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <img src="{{ asset('assets/uploads/categoria/' . $item->image) }}" class="cate-image"
                                    alt="image here">
                            </td>
                            <td>
                                <a href="{{ url('edit-categoria/' . $item->id) }}" class="btn btn-primary">Editar</a>
                                <a href="{{ url('delete-categoria/' . $item->id) }}" class="btn btn-danger">Deletar</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
