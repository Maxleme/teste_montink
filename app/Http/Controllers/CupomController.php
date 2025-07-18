<?php

namespace App\Http\Controllers;

use App\Interfaces\CupomRepositoryInterface;
use App\Http\Requests\CupomRequest;
use Illuminate\Http\Request;
use App\Models\Cupom;

class CupomController extends Controller
{
    private CupomRepositoryInterface $cupomRepository;

    public function __construct(CupomRepositoryInterface $cupomRepository)
    {
        $this->cupomRepository = $cupomRepository;
    }
    public function index()
    {
        $cupons = Cupom::all();
        return view("cupons.index", compact("cupons"));
    }

    public function getCreate()
    {
        return view("cupons.form");
    }

    public function postCreate(CupomRequest $request)
    {   
        $this->cupomRepository->criarCupom($request->validated());
        return redirect()->route('cupons.index')->with('success','Cupom criado');
    }

    public function getUpdate(Cupom $cupom)
    {
        return view('cupons.form', compact('cupom'));
    }

    public function putUpdate(CupomRequest $request, Cupom $cupom)
    {
        $this->cupomRepository->atualizarCupom($cupom, $request->validated());
        return redirect()->route('cupons.index')->with('success','Cupom modificado');
    }

    public function deleteCupom(Cupom $cupom)
    {
        $this->cupomRepository->excluirCupom($cupom);
        return redirect()->route('cupons.index')->with('success','Cupom excluido');
    }
}
