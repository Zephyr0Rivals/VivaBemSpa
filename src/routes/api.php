<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\ServicoController;
use App\Models\Servico;

Route::prefix('v1')->group(function(){

    // Status da API
    Route::get('/status', [StatusController::class, 'index']);
    

    // SERVIÇO
    Route::get('/servico', [ServicoController::class, 'index']);
 });