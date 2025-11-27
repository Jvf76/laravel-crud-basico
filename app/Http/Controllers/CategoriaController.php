<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    // Listar todas as categorias
    public function index()
    {
        $categorias = Categoria::all();

        // Criar o cookie com a data e hora atual
        $dataAtual = now()->format('d/m/Y H:i:s');
        
        // Retornar a view com o cookie
        return response()
            ->view('categorias.index', compact('categorias'))
            ->cookie('ultima_categoria_acessada', $dataAtual, 60 * 24 * 7); // Cookie válido por 7 dias
    }

    // Criar nova categoria
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|min:3',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoria cadastrada com sucesso!');
    }
}