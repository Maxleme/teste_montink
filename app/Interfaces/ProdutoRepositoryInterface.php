<?php

namespace App\Interfaces;

interface ProdutoRepositoryInterface
{
    public function criarProdutoComVariacoes(array $dados);
}