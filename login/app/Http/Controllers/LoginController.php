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
        $name = $_POST['name']; 
        $password = $_POST['password']; 
    
        $sql = "SELECT id FROM users WHERE name = '$name' and password = '$password'";

        $user = DB::select($sql);

        if (!empty($user)) {
            return response()->make("
                <h1>✅ Login bem-sucedido!</h1>
                <hr>
                <h3>🔎 Dados recebidos:</h3>
                <p>Nome: $name</p>
                <p>Senha: $password</p>
                <hr>
                <h3>🚨 SQL Executado:</h3>
                <pre>$sql</pre>
            ", 200, ['Content-Type' => 'text/html']);
        } else {
            return response()->make("
                <h1>❌ Login falhou!</h1>
                <h3>🔎 Dados recebidos:</h3>
                <p>Nome: $name</p>
                <p>Senha: $password</p>
                <hr>
                <h3>🚨 SQL Executado:</h3>
                <pre>$sql</pre>
            ", 200, ['Content-Type' => 'text/html']);
        }
    }
}
