<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisponibilidadeController extends Controller {
 
    public function dias(Request $request){
        // 1. Conferir o pedido: veio o que precisamos?
        $dados = $request->validate([
            'id_servico' => ['required', 'integer'],
            'terapeuta_id' => ['required', 'integer'],
            'mes'          => ['required', 'date_format:Y-m'],
        ]);

        // 2) Resposta de mentirinha (por enquanto)
        return response()->json([
            'mes'  => $dados['mes'],
            'dias' => [
                ['data' => $dados['mes'] . '-01', 'disponivel' => true],
                ['data' => $dados['mes'] . '-02', 'disponivel' => false],
            ],
        ]);

    }

}