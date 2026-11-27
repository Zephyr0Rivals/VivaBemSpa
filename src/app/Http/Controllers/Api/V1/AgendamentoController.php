<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Agendamento;

class AgendamentoController extends Controller{
    
    public function horariosLivres(Request $request, int $id): JsonResponse{
        
        $dados = $request->validate([
            'data' => 'required|date_format:Y-m-d|after_or_equal:today',
        ]);

        $servico = Servico::findOrFail($id);
        
        // Horários que já estão ocupados naquele dia, para aquele serviço
        $ocupados = Agendamento::where('id_servico', $servico->id_servico)
            ->where('data_agendamento', $dados['data'])
            ->pluck('id_horario');

        // O quadro inteiro, menos os ocupados
        $livres = Horario::whereNotIn('id_horario', $ocupados)
            ->orderBy('hora_inicio')
            ->get();

        return response()->json([
            'success'   => true,
            'total'     => $livres->count(),
            'data'      => $livres,
        ]);
    
    }

    public function store(Request $request): JsonResponse{
        $dados = $request->validate([
            'id_servico'    => 'required|integer',
            'id_horario'    => 'required|integer',
            'data'          => 'required|data_format:Y-m-d|after_or_equal:today'
        ]);
    }

}