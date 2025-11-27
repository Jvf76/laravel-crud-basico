<!DOCTYPE html>
<html>
<head>
    <title>Produtos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input, button { margin: 5px 0; padding: 5px; }
        label { display: block; margin-top: 10px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Produtos</h1>

    {{-- Mensagens de sucesso --}}
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    {{-- Mensagens de erro de validação --}}
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário de cadastro --}}
    <form action="/produtos" method="POST">
        @csrf
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Descrição:</label>
        <input type="text" name="descricao">

        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" required>

        <button type="submit">Cadastrar</button>
    </form>

    {{-- Lista de produtos --}}
    <h2>Lista de Produtos</h2>
    @if($produtos->isEmpty())
        <p>Nenhum produto cadastrado ainda.</p>
    @else
        <ul>
            @foreach($produtos as $produto)
                <li>{{ $produto->nome }} - {{ $produto->descricao ?? '-' }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
