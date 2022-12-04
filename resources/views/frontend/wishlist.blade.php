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
                <a href="{{ url('lista-desejos') }}">
                    Lista de Desejos
                </a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                @if ($lista_desejos->count() > 0)
                    @foreach ($lista_desejos as $item)
                        <div class="row produto_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('assets/uploads/produto/' . $item->produtos->image) }}" height="70px"
                                    width="70px" alt="Imagem aqui">
                            </div>
                            <div class="col-md-2 my-auto">
                                <h4>{{ $item->produtos->name }}</h4>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h4>R$ {{ $item->produtos->selling_price }}</h4>
                            </div>
                            <div class="col-md-2 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                @if ($item->produtos->qty >= $item->prod_qty)
                                    <label for="Quantidade">Quantidade</label>
                                    <div class="input-group text-center mb-3" style="width: 130px;">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" name="quantity" class="form-control qty-input text-center"
                                            value="1">
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                @else
                                    <h6>Fora de estoque</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-success addToCartBtn">
                                    &#128722;
                                    </i>Add ao Carrinho</button>
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger remove-listadesejos-item">
                                    &#128465;
                                    </i>Remover</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>Não há produtos em sua lista de desejos!</h4>
                @endif
            </div>

        </div>
    </div>
@endsection
