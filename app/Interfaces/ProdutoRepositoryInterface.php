<?php

namespace App\Interfaces;
use App\Models\Produto;

interface ProdutoRepositoryInterface
{
    public function criarProdutoComVariacoes(array $dados);

    public function atualizarProdutoComVariacoes(Produto $produto, array $dados);

    public function excluirProdutoComVariacoes(Produto $produto);
}