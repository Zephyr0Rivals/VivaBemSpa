<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    // Lista todos os serviços
    public function index(): JsonResponse
    {

        // 1- Consultar os serviços no Banco
        $categoria = Categoria::where('status_categoria', 'ATIVO')
        ->orderBy('nome_categoria', 'asc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'categorias consultadas com sucesso',
            'total' => $categoria->count(),
            'data' => $categoria

        ], 200);
        
    }

}