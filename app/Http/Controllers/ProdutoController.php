<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Interfaces\ProdutoRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    private ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }
    public function index()
    {   
        $produtos = Produto::all();
        return view("produtos.index", compact('produtos'));
    }

    public function getCreate()
    {
        return view("produtos.create");
    }

    public function postCreate(ProdutoRequest $request)
    {
        $produto = $this->produtoRepository->criarProdutoComVariacoes($request->validated());
        
        return redirect()->route('produtos.index')->with('success','Produto criado');

    }

    public function getUpdate(Produto $produto)
    {
        $produto->load('variacoes');
        return view("produtos.create", compact("produto"));
    }

    public function putUpdate(ProdutoRequest $request, Produto $produto)
    {
        $produto = $this->produtoRepository->atualizarProdutoComVariacoes($produto, $request->validated());
        return redirect()->route('produtos.index')->with('success','Produto editado');
    }

    public function getVer(Produto $produto)
    {   
        $produto->load('variacoes');
        return view("produtos.ver", compact('produto'));
    }

    public function deleteProduto(Produto $produto)
    {
        $this->produtoRepository->excluirProdutoComVariacoes($produto);
        
        return redirect()->route('produtos.index')
            ->with('success', 'Produto e variações excluídos com sucesso');
    }
}
