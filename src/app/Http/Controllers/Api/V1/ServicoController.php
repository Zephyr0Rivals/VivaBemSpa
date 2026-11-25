<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Servico;
use App\Models\Depoimento;
use App\Models\Cliente;

class ServicoController extends Controller
{
    // Lista todos os serviços
    public function index(): JsonResponse
    {

        // 1- Consultar os serviços no Banco
        $servico = Servico::where('status_servico', 'ATIVO')
        ->orderBy('nome_servico', 'asc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'servicos consultados com sucesso',
            'total' => $servico->count(),
            'data' => $servico

        ], 200);
        
    }

    // Listar um serviço específico 
    public function show(int $id): JsonResponse
    {
        $servicoAtual = Servico::where('status_servico', 'ATIVO')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'serviço {$id} consultado com sucesso',
            'data'    => $servicoAtual,
        ], 200);
    }

    // Lista um depoimento de um serviço específico
    public function depoimentos(int $id): JsonResponse
    {
        $servico = Servico::findOrFail($id);

        $depoimentos = $servico->depoimentos()
            ->where('status_depoimento', 'APROVADO')
            ->with('clientes:id_cliente,nome_cliente,foto_cliente')
            ->orderByDesc('id_depoimento')
            ->get();

        return response()->json([
            'success'   => true,
            'message'   => 'depoimentos consultados com sucesso',
            'total'     => $depoimentos->count(),
            'data'      => $depoimentos,
        ]);
    }
}
