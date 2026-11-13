<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Servico;

class ServicoController extends Controller
{
    // Lista todos os produtos
    public function index(): JsonResponse
    {

        // 1- Consultar os produtos no Banco
        $servico = Servico::where('status_servico', 'ATIVO')
        ->orderBy('nome_servico', 'asc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'galeria consultados com sucesso',
            'total' => $servico->count(),
            'data' => $servico

        ], 200);
        
    }
}
