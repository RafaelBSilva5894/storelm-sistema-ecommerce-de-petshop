@extends('layouts.front')

@section('title')
    {{ $categoria->name }}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('categoria') }}">
                    Coleções
                </a> /
                <a href="{{ url('categoria/' . $categoria->slug) }}">
                    {{ $categoria->name }}
                </a>
            </h6>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{ $categoria->name }}</h2>
                <div class="owl-carousel feature-carousel owl-theme">
                    @foreach ($produto as $prod)
                        <div class="col-md-6">
                            <div class="card">
                                <a href="{{ url('categoria/' . $categoria->slug . '/' . $prod->slug) }}">
                                    <img src="{{ asset('assets/uploads/produto/' . $prod->image) }}" alt="Image produto">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ $prod->selling_price }}</span>
                                        <span class="float-end"><s>{{ $prod->original_price }}</s></span>
                                    </div>
                                </a>
                            </div>
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
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 2,
                    nav: true,
                    loop: false
                }
            }
        })
    </script>
@endsection
