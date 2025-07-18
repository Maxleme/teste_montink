@extends('layouts.default')
@section('title', 'Criar Produto')
@section('content')

    

<div class="container mt-5">
    <form action="{{ isset($produto) ? route('produtos.editar', $produto->id) : route('produtos.criar') }}" method="POST">
        @csrf
        @if(isset($produto))
            @method('PUT')
        @endif
        <div class="row g-3">
            <div class="mb-3 col-8">
                <label class="form-label">Nome do Produto:</label>
                <input class="form-control" type="text" name="nome" value="{{ old('nome', $produto->nome ?? '') }}" required>
            </div>
            <div class="mb-3 col">
                <label class="form-label">Preço Base (R$):</label>
                <input class="form-control" type="number" step="0.01" name="preco" value="{{ old('nome', $produto->preco ?? '') }}" required>
            </div>
            <div class="mb-3 col">
                <label class="form-label">Estoque:*</label>                
                <input class="form-control" type="number" name="estoque" value="{{ old('estoque', $produto->estoque ?? 0) }}">
            </div>
            <h5>Variações <span class="fs-6">(opcional)</span></h5>
            <p class="fs-6">* Caso utilize variações o estoque será substituido pela soma do estoque das variações</p>
            <div id="variacoes-container" class="mb-3">
                @if(isset($produto))
                    @foreach($produto->variacoes as $variacao)
                    <div class="variacao row g-3 mb-4">
                        <div class="col">
                            <input class="form-control" type="text" name="variacoes[{{ $variacao->id }}][nome]" value="{{ $variacao->nome }}" placeholder="Tamanho/Cor" required>
                        </div>
                        <div class="col">
                            <input class="form-control" type="number" step="0.01" name="variacoes[{{ $variacao->id }}][preco]" value="{{ $variacao->preco }}" placeholder="Preço adicional">
                        </div>
                        <div class="col">
                            <input class="form-control" type="number" name="variacoes[{{ $variacao->id }}][estoque]" value="{{ $variacao->estoque }}" placeholder="Estoque" required>
                        </div>
                        <div class="col">
                            <button class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
                        </div>
                    </div>
                    @endforeach
                @endif    
            </div>       
        </div>
        <div class="row g-3">
            <div class="col">
                <button class="btn btn-secondary" type="button" onclick="addVariacao()">+ Adicionar Variação</button>
            </div>
        </div>
        <div class="row">
            <div class="col text-end mt-5">
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>
    <script>
        let variacaoCount = {{ isset($produto) && $produto->variacoes->isNotEmpty() ? 
                          $produto->variacoes->max('id') + 1 : 1 }};
        function addVariacao() {
            const container = document.getElementById('variacoes-container');
            const newVariacao = document.createElement('div');
            newVariacao.className = 'variacao row g-3 mb-4';
            newVariacao.innerHTML = `
                <div class="col">
                    <input class="form-control" type="text" name="variacoes[${variacaoCount}][nome]" placeholder="Tamanho/Cor" required>
                </div>
                <div class="col">
                    <input class="form-control" type="number" step="0.01" name="variacoes[${variacaoCount}][preco]" placeholder="Preço adicional">
                </div>
                <div class="col">
                    <input class="form-control" type="number" name="variacoes[${variacaoCount}][estoque]" placeholder="Estoque" required>
                </div>
                <div class="col">
                    <button class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
                </div>
            `;
            container.appendChild(newVariacao);
            variacaoCount++;
        }
    </script>
</div>
@endsection