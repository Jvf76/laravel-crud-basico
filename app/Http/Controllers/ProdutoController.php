<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * Exibe a página com a lista de produtos e o formulário de cadastro.
     */
    public function index()
    {
        // Busca todos os produtos, ordenando pelos mais recentes
        $produtos = Produto::orderBy('created_at', 'desc')->get();

        // Retorna a view 'produtos.index' e envia a lista de produtos para ela
        return view('produtos.index', ['produtos' => $produtos]);
    }

    /**
     * Salva um novo produto no banco de dados, incluindo a imagem.
     */
    public function store(Request $request)
    {
        // 1. Valida os dados recebidos do formulário
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Imagem opcional
        ]);

        $caminhoImagem = null;
        // 2. Verifica se um arquivo de imagem foi enviado
        if ($request->hasFile('imagem')) {
            // Salva o arquivo na pasta 'storage/app/public/produtos'
            // e armazena o caminho relativo (ex: 'produtos/nome_unico.jpg')
            $caminhoImagem = $request->file('imagem')->store('produtos', 'public');
        }

        // 3. Cria o produto no banco de dados com os dados validados
        Produto::create([
            'nome' => $dadosValidados['nome'],
            'descricao' => $dadosValidados['descricao'],
            'preco' => $dadosValidados['preco'],
            'imagem_path' => $caminhoImagem, // Salva o caminho da imagem na coluna correta
        ]);

        // 4. Redireciona o usuário de volta para a lista com uma mensagem de sucesso
        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    // AQUI VOCÊ ADICIONARIA OS OUTROS MÉTODOS (edit, update, destroy) QUANDO PRECISAR
    
    /**
     * Atualiza o produto no banco de dados.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados (use a mesma validação do store)
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|file|image|mimes:jpg,png|max:2048' 
        ]);

        $produto = Produto::findOrFail($id);

        // Lógica de Upload da Imagem para o update
        if ($request->hasFile('imagem')) {
            // Opcional: Deletar a imagem antiga antes de salvar a nova
            if ($produto->imagem_path) {
                \Storage::disk('public')->delete($produto->imagem_path);
            }
            
            $path = $request->file('imagem')->store('produtos', 'public');
            $validated['imagem_path'] = $path;
        }

        $produto->update($validated);

        // Redireciona para a lista de produtos com mensagem de sucesso
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove o produto do banco de dados.
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        // Deletar a imagem do storage antes de deletar o registro
        if ($produto->imagem_path) {
            \Storage::disk('public')->delete($produto->imagem_path);
        }

        $produto->delete();

        // Redireciona para a lista de produtos com mensagem de sucesso
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}

