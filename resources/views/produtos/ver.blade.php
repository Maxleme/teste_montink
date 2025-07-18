@extends('layouts.default')
@section('title', 'Detalhes do Produto')
@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <p><b>Produto:</b> {{ $produto->nome }}</p>
            <p><b>valor:</b> R$ {{ $produto->preco }}</p>
            <p><b>Qt em estoque:</b> {{ $produto->estoque }}</p>            
        </div>
        <div class="col">
            <form action="{{ route('carrinho.adicionar') }}" method="POST">
                @csrf
                <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                
                @if($produto->variacoes->count())
                    <h3>Variações</h3>
                    <select name="variacao_id" class="form-control" required>
                        <option value="">Selecione uma opção</option>
                        @foreach($produto->variacoes as $variacao)
                            <option value="{{ $variacao->id }}" 
                                {{ $variacao->estoque <= 0 ? 'disabled' : '' }}>
                                {{ $variacao->nome }}
                                @isset($variacao->preco)
                                    (+ R$ {{ number_format($variacao->preco, 2, ',', '.') }})
                                @endisset
                                {{ $variacao->estoque <= 0 ? '(Esgotado)' : '' }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <input type="hidden" name="variacao_id" value="0">
                @endif
                
                <div class="mt-3">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" name="quantidade" min="1" 
                        max="{{ $produto->estoque }}" value="1" class="form-control">
                </div>
                
                <button class="btn btn-primary mt-3" type="submit">Adicionar ao Carrinho</button>
            </form>
        </div>
    </div>
</div>
@endsection