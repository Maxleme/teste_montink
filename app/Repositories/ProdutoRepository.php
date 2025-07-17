<?php 

namespace App\Repositories;

use App\Interfaces\ProdutoRepositoryInterface;
use App\Models\Produto;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    public function criarProdutoComVariacoes(array $dados)
    {
        $produto = Produto::create([
            'nome' => $dados['nome'],
            'preco' => $dados['preco'],
            'estoque' => $dados['estoque_total']
        ]);

        if (isset($dados['variacoes'])) {
            foreach ($dados['variacoes'] as $variacao) {
                $produto->variacoes()->create([
                    'nome' => $variacao['nome'],
                    'preco' => $variacao['preco'] ?? null,
                    'estoque' => $variacao['estoque'],
                ]);
            }
        }

        return $produto;
    }
}