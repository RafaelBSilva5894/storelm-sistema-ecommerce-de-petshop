@extends('layouts.front')

@section('title', $produto->name)

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/adicionar-avaliacao') }}" method="post">
                    @csrf
                    <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Avalie {{ $produto->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($avaliacao_user)

                                    @for ($i = 1; $i <= $avaliacao_user->estrelas_avaliadas; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}">
                                            &#9733;
                                        </label>
                                    @endfor
                                    @for ($j = $avaliacao_user->estrelas_avaliadas + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}">
                                            &#9733;
                                        </label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1">
                                        &#9733;
                                    </label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2">
                                        &#9733;
                                    </label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3">
                                        &#9733;
                                    </label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4">
                                        &#9733;
                                    </label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5">
                                        &#9733;
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Avaliar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('categoria') }}">
                    Coleções
                </a> /

                <a href="{{ url('categoria/' . $produto->category->slug) }}">
                    {{ $produto->category->name }}

                </a> /

                <a href="{{ url('categoria/' . $produto->category->slug . '/' . $produto->slug) }}">
                    {{ $produto->name }}
                </a>
            </h6>
        </div>
    </div>

    <div class="container pb-5">
        <div class="produto_data">
            <div class="">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/produto/' . $produto->image) }}" class="w-100" alt="">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $produto->name }}
                            @if ($produto->trending == '1')
                                <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Em
                                    Alta</label>
                            @endif
                        </h2>
                        <hr>
                        <label class="me-3">Preço Original : <s>R$ {{ $produto->original_price }}</s></label>
                        <label class="fw-bold">Preço de venda : R$ {{ $produto->selling_price }}</label>
                        @php $numero_avaliacao = number_format($valor_avaliacao) @endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $numero_avaliacao; $i++)
                                <i style='font-size:28px' class="checked"> &#9733;
                                </i>
                            @endfor
                            @for ($j = $numero_avaliacao + 1; $j <= 5; $j++)
                                <i style='font-size:28px'> &#9733;
                                </i>
                            @endfor
                            <span>
                                @if ($avaliacoes->count() > 0)
                                    {{ $avaliacoes->count() }} Avaliações
                                @else
                                    Sem Avaliações
                                @endif
                            </span>
                        </div>

                        <p class="mt-3">
                            {!! $produto->small_description !!}
                        </p>
                        <hr>
                        @if ($produto->qty > 0)
                            <label class="badge bg-success">Em estoque</label>
                        @else
                            <label class="badge bg-danger">Sem estoque</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input type="hidden" value="{{ $produto->id }}" class="prod_id">
                                <label for="Quantidade">Quantidade</label>
                                <div class="input-group text-center mb-3" style="width: 130px;">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control qty-input text-center"
                                        value="1">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br />
                                @if ($produto->qty > 0)
                                    <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">
                                        Adicionar
                                        ao carrinho
                                        &#x1F6D2;
                                    </button>
                                @endif
                                <button type="button" class="btn btn-success me-3 addToWishlist float-start"> Adicionar à
                                    lista de desejos
                                    &#10084;
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <h3>Descrição</h3>
                        <p class="mt-3">
                            {!! $produto->description !!}
                        </p>
                    </div>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Avalie este Produto
                        </button>
                        <a href="{{ url('add-comentario/' . $produto->slug . '/usercomentario') }}" class="btn btn-link">
                            Deixe seu Comentário
                        </a>
                    </div>
                    <div class="col-md-8">
                        @foreach ($reviews as $item)
                            <div class="user_review">
                                <label for="">{{ $item->user->name . ' ' . $item->user->lname }}</label>
                                @if ($item->user_id == Auth::id())
                                    <a href="{{ url('edit-review/' . $produto->slug . '/usercomentario') }}">Editar</a>
                                @endif
                                <br>
                                @php
                                    $avaliacao = App\Models\Comentario::where('prod_id', $produto->id)
                                        ->where('user_id', $item->user->id)
                                        ->first();
                                @endphp
                                @if ($avaliacao)
                                    @php $user_rated = $avaliacao->estrelas_avaliadas  @endphp
                                    @for ($i = 1; $i <= $user_rated; $i++)
                                        <i style='font-size:28px' class="checked">
                                            &#9733;
                                        </i>
                                    @endfor
                                    @for ($j = $user_rated + 1; $j <= 5; $j++)
                                        <i style='font-size:28px'>
                                            &#9733;
                                        </i>
                                    @endfor
                                @endif
                                <small>Comentado em {{ $item->created_at->format('d M Y') }}</small>
                                <p>{{ $item->user_review }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
