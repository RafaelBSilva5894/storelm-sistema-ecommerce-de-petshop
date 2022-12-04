@extends('layouts.front')

@section('title')
    Categoria
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('categoria') }}">
                    Coleções
                </a>
            </h6>
        </div>
    </div>

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Todas categorias</h2>
                    <div class="row">
                        @foreach ($categoria as $cate)
                            <div class="col-md-3 mb-3">
                                <a href="{{ url('ver-categoria/' . $cate->slug) }}">
                                    <div class="card">
                                        <img src="{{ asset('assets/uploads/categoria/' . $cate->image) }}"
                                            alt="Imagem da Categoria">
                                        <div class="card-body">
                                            <h5>{{ $cate->name }}</h5>
                                            <p>
                                                {{ $cate->description }}
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
    </div>
@endsection
