<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Final - Gerenciamento de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100% );
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .navbar-custom {
            background: rgba(0, 0, 0, 0.3);
        }
        .container-main {
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        .lead {
            color: #666;
            margin-bottom: 30px;
        }
        .btn-lg {
            padding: 12px 30px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom position-fixed w-100 top-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Trabalho Final - Gerenciamento de Produtos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="navbar-text me-3">Olá, {{ Auth::user()->name }}!</span>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Registrar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-main mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1>Trabalho Final - Tópicos Especiais I</h1>
                <p class="lead">Sistema de Gerenciamento de Produtos em Laravel</p>
                
                @auth
                    <p class="mb-4">Bem-vindo ao sistema! Escolha uma opção abaixo:</p>
                    <div class="d-grid gap-3 mt-4">
                        <a href="/produtos" class="btn btn-primary btn-lg">Gerenciar Produtos</a>
                        <a href="/categorias" class="btn btn-success btn-lg">Gerenciar Categorias</a>
                    </div>
                @else
                    <p class="mb-4">Faça login ou registre-se para começar:</p>
                    <div class="d-grid gap-3 mt-4">
                        <a href="/login" class="btn btn-primary btn-lg">Login</a>
                        <a href="/register" class="btn btn-success btn-lg">Registrar</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
