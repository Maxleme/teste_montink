<?php 

namespace App\Repositories;

use App\Interfaces\ProdutoRepositoryInterface;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

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

    public function atualizarProdutoComVariacoes(Produto $produto, array $dados)
    {
        $produto->update([
            'nome' => $dados['nome'],
            'preco' => $dados['preco'],
            'estoque' => $dados['estoque_total'] ?? $dados['estoque']
        ]);
        
        if (isset($dados['variacoes'])) {
            $variacoesIds = [];
            
            foreach ($dados['variacoes'] as $variacao) {
                if (isset($variacao['id'])) {
                    $produto->variacoes()
                        ->where('id', $variacao['id'])
                        ->update([
                            'nome' => $variacao['nome'],
                            'preco' => $variacao['preco'] ?? null,
                            'estoque' => $variacao['estoque']
                        ]);
                    $variacoesIds[] = $variacao['id'];
                } else {
                    $newVariacao = $produto->variacoes()->create([
                        'nome' => $variacao['nome'],
                        'preco' => $variacao['preco'] ?? null,
                        'estoque' => $variacao['estoque']
                    ]);
                    $variacoesIds[] = $newVariacao->id;
                }
            }
            
            if (!empty($variacoesIds)) {
                $produto->variacoes()
                    ->whereNotIn('id', $variacoesIds)
                    ->delete();
            }

        } else {
            $produto->variacoes()->delete();
        }
        
        return $produto->fresh();
    }

    public function excluirProdutoComVariacoes(Produto $produto)
    {
        return DB::transaction(function () use ($produto) {
            $produto->variacoes()->delete();
            return $produto->delete();
        });
    }
}