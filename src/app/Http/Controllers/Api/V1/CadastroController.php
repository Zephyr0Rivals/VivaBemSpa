<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Psy\Util\Json;

class CadastroController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // 1- Confere se a ficha veio preenchida corretamente
            $dados = $request->validate([
                'nome'      => 'required|string|max:100',
                'email'     => 'required|email|max:100',
                'senha'     => 'required|string|min:8',
                
            ]);
        //
        // Deixa o e-mail sem espaços e tudo minúsculo
            $email = strtolower(trim($dados['email']));
        //

        // 2- Confere se o e-mail está na lista
            $verificao = Cliente::where('email_cliente', $email)->exists();

            if ($verificao) {
                return response()->json([
                    'success' => false,
                    'message' => 'este e-mail já está cadastrado',
                ], 409);
            }
        //

        //3- Não existe: pode criar
        $cliente = Cliente::create([
            'nome_cliente'      => $dados['nome'],
            'email_cliente'     => $email,
            'senha_cliente'     => Hash::make($dados['senha']), //
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'cadastro criado com sucesso',
            'data'      => $cliente,

        ], 201);


    }

    public function index(): JsonResponse{

        $consultaCliente = Cliente::where('status_cliente', 'ATIVO')
        ->orderBy('nome_cliente', 'asc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'clientes consultados com sucesso',
            'total' => $consultaCliente->count(),
            'data'=> $consultaCliente


        ], 200);

    }
}