<?php 

namespace App\Repositories;

use App\Interfaces\CupomRepositoryInterface;
use App\Models\Cupom;

class CupomRepository implements CupomRepositoryInterface
{
    public function criarCupom(array $dados)
    {
        $cupom = Cupom::create([
            'nome' => $dados['nome'],
            'codigo_cupom' => $dados['codigo_cupom'],
            'validade' => $dados['validade'],
            'valor_min' => $dados['valor_min'],
        ]);

        return $cupom;
    }

    public function atualizarCupom(Cupom $cupom, array $dados)
    {
        $cupom->update([
            'nome' => $dados['nome'],
            'codigo_cupom' => $dados['codigo_cupom'],
            'validade' => $dados['validade'],
            'valor_min' => $dados['valor_min']
        ]);
                
        return $cupom->fresh();
    }

    public function excluirCupom(Cupom $cupom)
    {
        return $cupom->delete();        
    }
}