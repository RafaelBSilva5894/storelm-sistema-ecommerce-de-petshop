@extends('layouts.admin')

@section('title')
    Pedidos
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Histórico de pedido
                            <a href="{{ 'pedidos' }}" class="btn btn-warning float-right">Novos Pedidos</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Data do Pedido</th>
                                    <th>Código de Rastreio</th>
                                    <th>Preço Total</th>
                                    <th>Status</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $item)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->total_price }}</td>
                                        <td>{{ $item->status == '0' ? 'pendente' : 'concluído' }}</td>
                                        <td>
                                            <a href="{{ url('admin/ver-pedido/' . $item->id) }}"
                                                class="btn btn-primary">Visualizar</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
