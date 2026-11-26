<?php

use App\Http\Controllers\Api\V1\CadastroController;
use App\Http\Controllers\Api\V1\CategoriaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\ServicoController;
use App\Http\Controllers\Api\V1\DisponibilidadeController;
use App\Http\Controllers\Api\V1\FavoritosController;
use KitLoong\MigrationsGenerator\Schema\Models\Index;

Route::prefix('v1')->group(function (){

    // STATUS DA API
    Route::get('/status', [StatusController::class, 'index']);


    // Servico
    Route::get('/servicos', [ServicoController::class, 'index']);
    Route::get('/servicos/{id}', [ServicoController::class, 'show']);
    Route::get('/servicos/{id}/depoimentos', [ServicoController::class, 'depoimentos']);
    
    //Disponibilidade
    Route::get('/disponibilidade/dias', [DisponibilidadeController::class, 'dias']);

    //Cliente
    Route::post('/cadastro', [CadastroController:: class, 'store']);
    Route::get('/cadastro/mac', [CadastroController:: class, 'index']);

    //Categoria
    Route::get('/categorias', [CategoriaController::class, 'index']);

    //Favoritos
    Route::get('/favoritos', [FavoritosController::class, 'index']);

});
