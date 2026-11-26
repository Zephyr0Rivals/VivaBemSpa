<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function dashboard()
{
    dd('DASHBOARD OK');
}
    // Exibir tela de login
    public function index()
    {
        return view('auth.login');
    }


    // Realizar login
    public function login(Request $request)
    {
        // 1 - Validar dados
        $dados = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);


        // 2 - Tentar autenticar
        $usuario = Usuario::where('email_usuario', $dados['email'])
                  ->where('status_usuario', 'ATIVO')
                  ->first();

if ($usuario && $dados['password'] === $usuario->senha_usuario) {

    Auth::login($usuario);

    $request->session()->regenerate();

    return redirect()->route('admin.dashboard');
}


        // 3 - Login inválido
        return back()
            ->withErrors([
                'email' => 'E-mail ou senha incorretos.',
            ])
            ->onlyInput('email');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logout realizado com sucesso.');
            
    }
}
