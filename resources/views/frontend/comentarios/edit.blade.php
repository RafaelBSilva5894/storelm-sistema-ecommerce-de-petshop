@extends('layouts.front')

@section('title', 'Edite seu Comentário')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Você está escrevendo um comentário para {{ $review->produto->name }}</h5>
                        <form action="{{ url('/atualizar-comentario') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <textarea class="form-control" name="user_review" rows="5" placeholder="Deixe seu Comentário">{{ $review->user_review }}</textarea>
                            <button type="submit" class="btn btn-primary mt-3">Atualizar Comentário</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
