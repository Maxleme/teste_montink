@extends('layouts.default')
@section('title', 'Meu Carrinho')
@section('content')

<div class="container mt-5">
    <h2>Meu Carrinho</h2>
    
    @if(count($carrinho) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Variação</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrinho as $chave => $item)
                <tr>
                    <td>{{ $item['nome'] }}</td>
                    <td>{{ $item['variacao_nome'] ?? 'N/A' }}</td>
                    <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                    <td>{{ $item['quantidade'] }}</td>
                    <td>R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('carrinho.remover', $chave) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th colspan="2">R$ {{ number_format($total, 2, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
        
        <div class="text-end">
            <a href="{{ route('produtos.index') }}" class="btn btn-primary">Finalizar Compra</a>
        </div>
    @else
        <div class="alert alert-info">
            Seu carrinho está vazio.
        </div>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Continuar Comprando</a>
    @endif
</div>

@endsection