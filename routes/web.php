<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get("/", [ProdutoController::class, "index"])->name("produtos.index");
Route::get("produto/criar", [ProdutoController::class, "getCreate"])->name("produtos.criar");
Route::post("produto/criar", [ProdutoController::class, "postCreate"])->name("produtos.criar");
