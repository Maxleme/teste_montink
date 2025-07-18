<?php

namespace App\Interfaces;
use App\Models\Cupom;

interface CupomRepositoryInterface
{
    public function criarCupom(array $dados);

    public function atualizarCupom(Cupom $cupom, array $dados);

    public function excluirCupom(Cupom $cupom);
}