<?php

use Illuminate\Support\Facades\Routes;

use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\ServicoController;
use App\Http\Controllers\Api\V1\DisponibilidadeController;


Route::prefix('v1')->group(function (){

    // STATUS DA API
    Route::get('/status', [StatusController::class, 'index']);

    // Produto
    Route::get('/servico', [ServicoController::class, 'index']);

    
    //Disponibilidade
    Route::get('/disponibilidade/dias', [DisponibilidadeController::class, 'dias']);

});

