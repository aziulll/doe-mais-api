<?php

namespace App\Http\Controllers;

use App\Models\DoacaoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoacoesController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados enviados pelo cliente
        $request->validate([
            'local' => 'required',
            
        ]);

        // Crie uma nova doação
        $doacao = new DoacaoModel();
        $doacao->local = $request->local;
        $doacao->user_id = Auth::id(); // Obtém o ID do usuário logado

        // Salve a doação
        $doacao->save();

        // Retorne uma resposta de sucesso
        return response()->json(['message' => 'Doação registrada com sucesso'], 201);
    }
}

