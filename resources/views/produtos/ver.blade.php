@extends('layouts.default')
@section('title', 'Detalhes do Produto')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <p>{{ $produto->nome }}</p>
            <p>{{ $produto->preco }}</p>
            <p>{{ $produto->estoque }}</p>            
        </div>
        <div class="col">
            @if($produto->variacoes->count())
                <h3>Variações</h3>
                @foreach($produto->variacoes as $variacao)
                    <p>{{ $variacao->nome }} - {{ $variacao->preco }} - {{ $variacao->estoque }}</p>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection