#!/bin/bash
echo "🚀 Iniciando instalação do Laravel..."

# Instalar PHP e dependências
sudo apt update
sudo apt install -y php php-curl php-zip php-xml php-gd php-mbstring

# Instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Criar projeto Laravel
composer create-project laravel/laravel aps-laravel
cd aps-laravel

# Configurar SQLite
touch database/database.sqlite

echo "✅ Instalação concluída!"
echo "📝 Agora execute os comandos restantes do passo a passo"