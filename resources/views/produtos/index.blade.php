@extends('layouts.default')
@section('content')

<div class="container mt-5">
    <div class="row text-end">
        <div class="col text-end">
            <a class="btn btn-primary" href="produto/criar">Criar produto</a>
        </div>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col" class="text-end">Preço</th>
                    <th scope="col" class="text-end">Estoque</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                <tr>
                    <td><a href={{ url('/produto/ver/' . $produto->id) }}>{{$produto->nome}}</a></td>
                    <td class="text-end">R$ {{ $produto->preco }}</td>
                    <td class="text-end">{{ $produto->estoque }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('produtos.editar', [$produto->id]) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('produtos.excluir', $produto->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirmarExclusao(event)">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
function confirmarExclusao(event) {
    if (!confirm('Tem certeza que deseja excluir este produto e todas suas variações?')) {
        event.preventDefault(); // Cancela a navegação
        return false;
    }
    return true;
}
</script>
@endsection


