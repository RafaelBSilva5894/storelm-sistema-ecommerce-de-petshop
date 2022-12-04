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
                        </h4>
                        <a href="{{ url('meus-pedidos') }}" class="btn btn-warning float-end">Voltar</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 detalhes-pedido">
                                <h4>Detalhes do Envio</h4>
                                <hr>
                                <label for="">Primeiro Nome</label>
                                <div class="border">{{ $pedidos->fname }}</div>
                                <label for="">Sobrenome</label>
                                <div class="border">{{ $pedidos->lname }}</div>
                                <label for="">Email</label>
                                <div class="border">{{ $pedidos->email }}</div>
                                <label for="">CPF</label>
                                <div class="border">{{ $pedidos->cpf }}</div>
                                <label for="">Telefone</label>
                                <div class="border">{{ $pedidos->phone }}</div>
                                <label for="">Endereço de Entrega</label>
                                <div class="border">
                                    {{ $pedidos->address }}, <br>
                                    {{ $pedidos->numero }}, <br>
                                    {{ $pedidos->bairro }}, <br>
                                    {{ $pedidos->city }}, <br>
                                    {{ $pedidos->state }},
                                </div>
                                <label for="">CEP</label>
                                <div class="border">{{ $pedidos->cep }}</div>
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
                                <h6 class="px-2">Modo de Pagamento: {{ $pedidos->payment_mode }}</h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
