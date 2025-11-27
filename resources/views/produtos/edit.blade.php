<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100% );
        }
        .product-image-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-top: 10px;
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Editar Produto</h1>

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

                <!-- Formulário de Edição -->
                <div class="card">
                    <div class="card-body">
                        <form action="/produtos/{{ $produto->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Produto *</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                                       id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                          id="descricao" name="descricao" rows="3">{{ old('descricao', $produto->descricao) }}</textarea>
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="preco" class="form-label">Preço (R$) *</label>
                                <input type="number" step="0.01" class="form-control @error('preco') is-invalid @enderror" 
                                       id="preco" name="preco" value="{{ old('preco', $produto->preco) }}" required>
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

                                @if($produto->imagem)
                                    <div class="mt-3">
                                        <label class="form-label">Imagem Atual:</label>
                                        <div>
                                            <img src="{{ asset('storage/' . $produto->imagem) }}" 
                                                 alt="{{ $produto->nome }}" class="product-image-preview">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Atualizar Produto</button>
                                <a href="/produtos" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
