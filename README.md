🗂️ Sistema Acadêmico em Laravel
Aplicação web desenvolvida como projeto acadêmico utilizando o framework Laravel (PHP), com foco em operações CRUD, rotas, controllers e views com Blade.

🚀 Funcionalidades

Cadastro e gerenciamento de usuários
Operações CRUD completas (Create, Read, Update, Delete)
Rotas organizadas com controllers dedicados
Views dinâmicas com Blade (template engine do Laravel)
Banco de dados com Migrations


🛠️ Tecnologias Utilizadas
TecnologiaUsoPHPLinguagem backendLaravelFramework MVCBladeTemplate engine (views)MySQLBanco de dados relacionalComposerGerenciamento de dependênciasViteBundler de assets

▶️ Como Executar
Pré-requisitos: PHP 8.1+, Composer, MySQL
bash# Clone o repositório
git clone https://github.com/Jvf76/laravel-crud-basico.git
cd laravel-crud-basico

# Execute o script de setup automático
bash setup.sh

# Ou manualmente:
composer install
cp .env.example .env
php artisan key:generate

# Configure o banco no .env e rode as migrations
php artisan migrate

# Inicie o servidor
php artisan serve
Acesse: http://localhost:8000

📁 Estrutura do Projeto
laravel-crud-basico/
├── app/
│   ├── Http/Controllers/   # Lógica das rotas
│   └── Models/             # Modelos Eloquent
├── database/
│   └── migrations/         # Estrutura do banco de dados
├── resources/
│   └── views/              # Templates Blade
├── routes/
│   └── web.php             # Definição das rotas
├── .env.example            # Modelo de configuração
└── setup.sh                # Script de instalação

📚 Conceitos Aplicados

Padrão MVC (Model-View-Controller)
Eloquent ORM para acesso ao banco de dados
Migrations para versionamento do schema
Rotas RESTful com Laravel Router
Templates reutilizáveis com Blade


👨‍💻 Autor
João Vítor Fernandes Caixeta
Estudante de Sistemas de Informação — UNIPAM
Estagiário de TI (NOC) — Uai Telecom
