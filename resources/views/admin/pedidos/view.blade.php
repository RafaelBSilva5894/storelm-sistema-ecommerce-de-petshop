@extends('layouts.front')

@section('title')
    Meus Pedidos
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Visualização do Pedido
                            <a href="{{ url('pedidos') }}" class="btn btn-warning float-right">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 detalhes-pedido">
                                <h4>Detalhes do Envio</h4>
                                <hr>
                                <label for="">Primeiro Nome</label>
                                <div class="border p-2 mt-0">{{ $pedidos->fname }}</div>
                                <label for="">Sobrenome</label>
                                <div class="border p-2 mt-0">{{ $pedidos->lname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2 mt-0">{{ $pedidos->email }}</div>
                                <label for="">CPF</label>
                                <div class="border p-2 mt-0">{{ $pedidos->cpf }}</div>
                                <label for="">Telefone</label>
                                <div class="border p-2 mt-0">{{ $pedidos->phone }}</div>
                                <label for="">Endereço de Entrega</label>
                                <div class="border p-2 mt-0">
                                    {{ $pedidos->address }}, <br>
                                    {{ $pedidos->numero }}, <br>
                                    {{ $pedidos->bairro }}, <br>
                                    {{ $pedidos->city }}, <br>
                                    {{ $pedidos->state }},
                                </div>
                                <label for="">CEP</label>
                                <div class="border p-2 mt-0">{{ $pedidos->cep }}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>Detalhes do Pedido</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Quantidade</th>
                                            <th>Preço</th>
                                            <th>Imagem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pedidos->itenspedido as $item)
                                            <tr>
                                                <td>{{ $item->produtos->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/produto/' . $item->produtos->image) }}"
                                                        width="50px" alt="Imagem Produto">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Total Geral: <span class="float-end">{{ $pedidos->total_price }}</span>
                                </h4>
                                <div class="mt-5 px-2">
                                    <label for="">Status do Pedido</label>
                                    <form action="{{ url('atualizar-pedido/' . $pedidos->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select" name="pedido_status">
                                            <option {{ $pedidos->status == '0' ? 'selected' : '' }} value="0">Pendente
                                            </option>
                                            <option {{ $pedidos->status == '1' ? 'selected' : '' }} value="1">
                                                Concluído
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-primary float-end mt-3">Atualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
