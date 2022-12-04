@extends('layouts.front')

@section('title')
    Bem-vindo a loja virtual StoreLM
@endsection

@section('content')
    @include('layouts.inc.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Produtos em destaque</h2>
                <div class="owl-carousel feature-carousel owl-theme">
                    @foreach ($feature_produtos as $prod)
                        <div class="item">
                            <div class="card">
                                <a href="{{ url('categoria/' . $prod->category->slug . '/' . $prod->slug) }}">
                                    <img src="{{ asset('assets/uploads/produto/' . $prod->image) }}" alt="Product image">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ $prod->selling_price }}</span>
                                        <span class="float-end"> <s> {{ $prod->original_price }}</s></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Categorias em alta</h2>
                <div class="owl-carousel feature-carousel owl-theme">
                    @foreach ($trending_categoria as $tcategoria)
                        <div class="item">
                            <a href="{{ url('ver-categoria/' . $tcategoria->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/categoria/' . $tcategoria->image) }}"
                                        alt="Image produto">
                                    <div class="card-body">
                                        <h5>{{ $tcategoria->name }}</h5>
                                        <p>
                                            {{ $tcategoria->description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.feature-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endsection
