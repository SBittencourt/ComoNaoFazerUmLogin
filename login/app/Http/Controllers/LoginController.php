<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        // Simulação do SQL (pra exibir na tela)
        $simulatedSQL = "SELECT * FROM users WHERE name = $name AND password = $password";

        // Consulta real (vulnerável!)
        $sql = "SELECT * FROM users WHERE name = $name AND password = $password";
        $user = DB::select($sql);

        if (!empty($user)) {
            return response()->make("
                <h1>✅ Login bem-sucedido!</h1>
                <p><strong>Usuário autenticado:</strong> {$user[0]->name}</p>
                <hr>
                <h3>🔎 Dados recebidos:</h3>
                <p>Nome: $name</p>
                <p>Senha: $password</p>
                <hr>
                <h3>🚨 SQL Executado:</h3>
                <pre>$simulatedSQL</pre>
            ", 200, ['Content-Type' => 'text/html']);
        } else {
            return response()->make("
                <h1>❌ Login falhou!</h1>
                <h3>🔎 Dados recebidos:</h3>
                <p>Nome: $name</p>
                <p>Senha: $password</p>
                <hr>
                <h3>🚨 SQL Executado:</h3>
                <pre>$simulatedSQL</pre>
            ", 200, ['Content-Type' => 'text/html']);
        }
    }
}
