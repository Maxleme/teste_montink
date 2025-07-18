<?php

use App\Http\Controllers\ProdutoController;
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
