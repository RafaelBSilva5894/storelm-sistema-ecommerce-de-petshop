@extends('layouts.front')

@section('title')
    Meu carrinho
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('carrinho') }}">
                    Carrinho
                </a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow cartitems">
            @if ($carrinhoItems->count() > 0)
                <div class="card-body">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($carrinhoItems as $item)
                        <div class="row produto_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('assets/uploads/produto/' . $item->produtos->image) }}" height="70px"
                                    width="70px" alt="Imagem aqui">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h4>{{ $item->produtos->name }}</h4>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h4>R$ {{ $item->produtos->selling_price }}</h4>
                            </div>
                            <div class="col-md-3 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                @if ($item->produtos->qty >= $item->prod_qty)
                                    <label for="Quantidade">Quantidade</label>
                                    <div class="input-group text-center mb-3" style="width: 130px;">
                                        <button class="input-group-text changeQuantidade decrement-btn">-</button>
                                        <input type="text" name="quantity" class="form-control qty-input text-center"
                                            value="{{ $item->prod_qty }}">
                                        <button class="input-group-text changeQuantidade increment-btn">+</button>
                                    </div>
                                    @php
                                        $total += $item->produtos->selling_price * $item->prod_qty;
                                    @endphp
                                @else
                                    <h6>Fora de estoque</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger delete-cart-item">
                                    &#128465;
                                    </i>Remover</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <h6>Preço total : R$ {{ $total }}
                        <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Fazer o check-out</a>
                    </h6>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Seu &#128722;
                        Carrinho está vazio!</h2>
                    <a href="{{ url('categoria') }}" class="btn btn-outline-primary float-end">Continue Comprando</a>
                </div>
            @endif
        </div>
    </div>
@endsection
