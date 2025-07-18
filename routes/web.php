<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\CarrinhoController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get("/", [ProdutoController::class, "index"])->name("produtos.index");
Route::get("produto/criar", [ProdutoController::class, "getCreate"])->name("produtos.criar");
Route::post("produto/criar", [ProdutoController::class, "postCreate"])->name("produtos.criar");
Route::get("produto/ver/{produto}", [ProdutoController::class, "getVer"])->name("produtos.ver");
Route::get("produto/editar/{produto}", [ProdutoController::class, "getUpdate"])->name("produtos.editar");
Route::put("produto/editar/{produto}", [ProdutoController::class, "putUpdate"])->name("produtos.editar");
Route::delete("produto/excluir/{produto}", [ProdutoController::class, "deleteProduto"])->name("produtos.excluir");

Route::get("cupons", [CupomController::class, "index"])->name("cupons.index");
Route::get("cupom/criar", [CupomController::class, "getCreate"])->name("cupons.criar");
Route::post("cupom/criar", [CupomController::class, "postCreate"])->name("cupons.criar");
Route::get("cupom/editar/{cupom}", [CupomController::class, "getUpdate"])->name("cupons.editar");
Route::put("cupom/editar/{cupom}", [CupomController::class, "putUpdate"])->name("cupons.editar");
Route::delete("cupom/excluir/{cupom}", [CupomController::class, "deleteCupom"])->name("cupons.excluir");

Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::get('/carrinho', [CarrinhoController::class, 'ver'])->name('carrinho.ver');
Route::post('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');