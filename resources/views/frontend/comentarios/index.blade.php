@extends('layouts.front')

@section('title', 'Deixe seu Comentário')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($compra_verificada->count() > 0)
                            <h5>Você está escrevendo um comentário para {{ $produto->name }}</h5>
                            <form action="{{ url('/add-comentario') }}" method="POST">
                                @csrf
                                <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                                <textarea class="form-control" name="user_review" rows="5" placeholder="Deixe seu Comentário"></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Enviar Comentário</button>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                <h5>Você não está qualificado para avaliar este produto!</h5>
                                <p>Para a confiabilidade das avaliações, apenas os clientes que compraram o produto podem
                                    escrever uma avaliação sobre o produto!
                                </p>
                                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Voltar para a página inicial</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
