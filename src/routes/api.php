<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\StatusController;
use App\Http\Controllers\Api\V1\CadastroController;
use App\Http\Controllers\Api\V1\ServicoController;
use App\Http\Controllers\Api\V1\DisponibilidadeController;
use App\Http\Controllers\Api\V1\FavoritosController;
use App\Http\Controllers\Api\V1\AgendamentoController;
use KitLoong\MigrationsGenerator\Schema\Models\Index;


Route::prefix('v1')->group(function(){

    // Status da API
    Route::get('/status', [StatusController::class, 'index']);
    
    //Cadastros
    Route::post('/cadastro', [CadastroController::class, 'store']);
    Route::get('/cadastro', [CadastroController::class, 'index']);

    //Categoria
    Route::get('/categorias', [CategoriaController::class, 'index']);
    

    // SERVIÇO
    Route::get('/servicos', [ServicoController::class, 'index']);
    Route::get('/servicos/{id}', [ServicoController::class, 'show']);
    Route::get('/servicos/{id}/depoimentos', [ServicoController::class, 'depoimentos']);
  

    //Favoritos
    Route::get('/favoritos', [FavoritosController::class, 'index']);

    //Agendamentos
    Route::get('/servicos/{id}/horarios', [AgendamentoController::class, 'horariosLivres']);
    
    // ex: GET /api/v1/servicos/3/horarios?data=2026-12-15 
    // (o "?data" serve para específicar uma data, não sendo 
    // obrigatório para buscar um serviço específico)
}); 
