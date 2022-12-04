@extends('layouts.admin')

@section('content')
    <div class="card py-5">
        <div class="card-body">
            <h1><b>StoreLM</b></h1>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-primary">
                                <h4 class="font-weight-bold text-white font-weight-bold">Total de Categorias :
                                    {{ $categoria }} </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-secondary">
                                <h4 class="font-weight-bold text-white">Total de Produtos : {{ $produto }} </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-warning">
                                <h4 class="font-weight-bold ">Total de Usuários : {{ $users }} </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-info">
                                <h4 class="font-weight-bold text-white">Total de Pedidos : {{ $total_pedidos }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
