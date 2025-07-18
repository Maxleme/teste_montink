@extends('layouts.default')
@section('content')

<div class="container mt-5">
    <div class="row text-end">
        <div class="col text-end">
            <a class="btn btn-primary" href="cupom/criar">Criar cupom</a>
        </div>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Cupom</th>
                    <th scope="col" class="text-end">Codigo</th>
                    <th scope="col" class="text-end">Validade</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
            @if($cupons->count())
                @foreach ($cupons as $cupom)
                <tr>
                    <td>{{$cupom->nome}}</td>
                    <td class="text-end">{{ $cupom->codigo_cupom }}</td>
                    <td class="text-end">{{ $cupom->validade->format('d-m-Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('cupons.editar', [$cupom->id]) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('cupons.excluir', $cupom->id) }}" method="post" class="d-inline">
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
            @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    function confirmarExclusao(event) {
        if (!confirm('Tem certeza que deseja excluir este cupom?')) {
            event.preventDefault(); // Cancela a navegação
            return false;
        }
        return true;
    }
</script>
@endsection


