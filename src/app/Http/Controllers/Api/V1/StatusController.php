<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use JsonException;

class StatusController extends Controller{

    public function index(): JsonResponse
    {
        return response()->json([
            'success'=> true,
            'data' =>  [
                'aplicacao' => 'Casa do Barista',
                'api' => 'V1',
                'status' => 'online',
            ]
        ]);
    }
}