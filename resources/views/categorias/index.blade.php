<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100% );
        }
        .cookie-info {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #bee5eb;
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
            <a class="navbar-brand" href="/">Gerenciamento de Categorias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/produtos">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Início</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Categorias</h1>

        <!-- Informação do Cookie -->
        @if(request()->cookie('ultima_categoria_acessada'))
            <div class="cookie-info">
                <strong>🍪 Informação do Cookie:</strong>  

                Última vez que você acessou esta página: <strong>{{ request()->cookie('ultima_categoria_acessada') }}</strong>
            </div>
        @endif

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
                <h5 class="mb-0">Cadastrar Nova Categoria</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/categorias">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria *</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                               id="nome" name="nome" value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar Categoria</button>
                    <a href="/" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- Lista de Categorias -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Lista de Categorias</h5>
            </div>
            <div class="card-body">
                @if($categorias->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Data de Criação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->id }}</td>
                                    <td>{{ $categoria->nome }}</td>
                                    <td>{{ $categoria->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-3">Nenhuma categoria cadastrada ainda.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
