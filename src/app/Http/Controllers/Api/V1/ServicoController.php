<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Servico;



class ServicoController extends Controller
{
    // Listar todos os servico
    public function index(): JsonResponse
    {
        // 1- Consultar os servico no banco
        $servico = Servico::where('status_servico', 'ATIVO')
        ->orderBy('nome_servico', 'asc')
        ->get();

       

        return response()->json([
            'success' => true,
            'message' => 'serviços consultados com sucesso',
            'total'   => $servico->count(),
            'data'    => $servico
        ], 200);
    }
}