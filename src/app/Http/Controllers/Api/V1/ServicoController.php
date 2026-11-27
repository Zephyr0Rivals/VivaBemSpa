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

    // Buscar um id específico
    public function show(int $id): JsonResponse
    {
        $servico = Servico::where('status_servico', 'ATIVO')->findOrFail($id);

        return response()->json([
            'success'   => true,
            'message'   => 'serviço consultado com sucesso',
            'data'      => $servico,
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
    // Buscar os horários de um serviço especifíco
    public function horarios(int $id): JsonResponse
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

