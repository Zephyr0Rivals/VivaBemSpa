<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Favoritos;

class FavoritosController extends Controller
{
    // Lista todos os Favoritos
    public function index(): JsonResponse
    {

        // 1- Consultar os favoritos no Banco
        $favoritos = Favoritos::where('status_favoritos', 'ATIVO')
        ->orderBy('id_favoritos', 'asc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'favoritos consultadas com sucesso',
            'total' => $favoritos->count(),
            'data' => $favoritos

        ], 200);
        
    }

}