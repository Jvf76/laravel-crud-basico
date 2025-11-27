<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100% );
        }
        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }
        .btn-edit:hover {
            background-color: #e0a800;
            color: #000;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-delete:hover {
            background-color: #c82333;
            color: #fff;
        }
        .product-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }
        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }
        .error-box li {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Gerenciamento de Produtos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text me-3">Olá, {{ Auth::user()->name }}!</span>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Produtos</h1>

        <!-- Mensagem de Sucesso -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Mensagens de Erro de Validação -->
        @if ($errors->any())
            <div class="error-box">
                <strong>Erro na validação:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de Cadastro -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Cadastrar Novo Produto</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/produtos" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Produto *</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                               id="nome" name="nome" value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                  id="descricao" name="descricao" rows="3" placeholder="Opcional">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço (R$) *</label>
                        <input type="number" step="0.01" class="form-control @error('preco') is-invalid @enderror" 
                               id="preco" name="preco" value="{{ old('preco') }}" required>
                        @error('preco')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem do Produto (PNG ou JPG)</label>
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror" 
                               id="imagem" name="imagem" accept="image/png,image/jpeg">
                        <small class="form-text text-muted">Máximo 2MB. Formatos aceitos: PNG, JPG</small>
                        @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                    <a href="/" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- Lista de Produtos -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Lista de Produtos</h5>
            </div>
            <div class="card-body">
                @if($produtos->count() > 0)
                    <div class="table-responsive">
                        {{-- CÓDIGO CORRIGIDO --}}
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Data de Criação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
        <tr>
            <td>
                {{-- CORREÇÃO APLICADA AQUI --}}
                @if($produto->imagem_path)
                    <img src="{{ asset('storage/' . $produto->imagem_path) }}" 
                         alt="{{ $produto->nome }}" class="product-image">
                @else
                    <span class="badge bg-secondary">Sem imagem</span>
                @endif
            </td>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->descricao ?: 'Nenhuma descrição' }}</td>
            <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
            <td>{{ $produto->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <a href="/produtos/{{ $produto->id }}/edit" class="btn btn-sm btn-edit">Editar</a>
                <form action="/produtos/{{ $produto->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-delete" 
                            onclick="return confirm('Tem certeza que deseja deletar este produto?')">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                    </div>
                @else
                    <p class="text-muted text-center py-3">Nenhum produto cadastrado ainda.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
