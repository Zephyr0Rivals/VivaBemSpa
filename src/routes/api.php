<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\ServicoController;
use App\Http\Controllers\Api\V1\DisponibilidadeController;
use App\Http\Controllers\Api\V1\FavoritosController;
use KitLoong\MigrationsGenerator\Schema\Models\Index;


Route::prefix('v1')->group(function(){

    // Status da API
    Route::get('/status', [StatusController::class, 'index']);
    

    //Favoritos
    Route::get('/favoritos', [FavoritosController::class, 'index']);

});
