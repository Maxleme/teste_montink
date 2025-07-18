@extends('layouts.default')
@section('title', 'Criar Cupom')
@section('content')

    

<div class="container mt-5">
    <form action="{{ isset($cupom) ? route('cupons.editar', $cupom->id) : route('cupons.criar') }}" method="POST">
        @csrf
        @if(isset($cupom))
            @method('PUT')
        @endif
        <div class="row g-3">
            <div class="mb-3 col-8">
                <label class="form-label">Nome do Cupom:</label>
                <input class="form-control" type="text" name="nome" value="{{ old('nome', $cupom->nome ?? '') }}" required>
            </div>            
            <div class="mb-3 col">
                <label class="form-label">Valor minimo:</label>
                <input class="form-control" type="number" step="0.01" name="valor_min" value="{{ old('valor_min', $cupom->valor_min ?? '') }}" required>
            </div>
            <div class="mb-3 col">
                <label class="form-label">Validade:</label>                
                <input class="form-control" type="date" name="validade" value="{{ old('validade', isset($cupom) ? $cupom?->validade->format('Y-m-d') : '') }}">
            </div>                   
        </div>
        <div class="row">
            <div class="mb-3 col">
                <label class="form-label">Codigo do cupom:</label>
                <input class="form-control" type="text" name="codigo_cupom" value="{{ old('codigo_cupom', $cupom->codigo_cupom ?? '') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col text-end mt-5">
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>
@endsection