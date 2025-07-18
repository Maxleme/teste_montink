<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Variacao;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function adicionar(Request $request)
    {
        
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1'
        ]);
        $produto = Produto::findOrFail($request->produto_id);
        
        $variacao = $request->variacao_id != 0 ? Variacao::find($request->variacao_id) : null;
        
        $estoqueDisponivel = $variacao ? $variacao->estoque : $produto->estoque;
        if ($request->quantidade > $estoqueDisponivel) {
            return back()->with('error', 'Quantidade solicitada maior que o estoque disponível');
        }
        
        $carrinho = session()->get('carrinho', []);
        if($variacao !== null)
        {
            $preco = $produto->preco + $variacao->preco;
        }else{
            $preco = $produto->preco;
        }
        $chave = $produto->id . '-' . ($variacao ? $variacao->id : '0');
        if (isset($carrinho[$chave])) {
            $carrinho[$chave]['quantidade'] += $request->quantidade;
        } else {
            $carrinho[$chave] = [
                'produto_id' => $produto->id,
                'variacao_id' => $variacao ? $variacao->id : null,
                'nome' => $produto->nome,
                'variacao_nome' => $variacao ? $variacao->nome : null,
                'preco' => $preco,
                'quantidade' => $request->quantidade,
                'imagem' => $produto->imagem
            ];
        }
        
        session()->put('carrinho', $carrinho);
        
        return redirect()->route('carrinho.ver')->with('success', 'Produto adicionado ao carrinho!');
    }
    
    public function ver()
    {
        $carrinho = session()->get('carrinho', []);
        $total = 0;
        
        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }
        
        return view('carrinho.ver', compact('carrinho', 'total'));
    }
    
    public function remover($chave)
    {
        $carrinho = session()->get('carrinho', []);
        
        if (isset($carrinho[$chave])) {
            unset($carrinho[$chave]);
            session()->put('carrinho', $carrinho);
        }
        
        return back()->with('success', 'Item removido do carrinho');
    }
}