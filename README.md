<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Logo do Laravel"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Status de Compilação"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total de Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Última Versão Estável"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="Licença"></a>
</p>

# Projeto de Blog com Laravel e Vue

Este projeto é uma aplicação de blog construída utilizando Laravel como framework backend e Vue.js para o frontend. Ele combina o poder das robustas capacidades de backend do Laravel com a arquitetura reativa e baseada em componentes do Vue para criar uma plataforma de blog moderna e eficiente.

## Características

- API RESTful com Laravel
- Frontend dinâmico com Vue.js
- [Adicione mais características específicas do seu projeto de blog]

## Como Começar

Para configurar e executar este projeto, siga os passos abaixo:

1. Clone o repositório para sua máquina local.

2. Instale as dependências do PHP usando Composer:
   ```
   composer install
   ```

3. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente as relacionadas ao banco de dados.

4. Gere uma nova chave de aplicação:
   ```
   php artisan key:generate
   ```

5. Instale as dependências do JavaScript:
   ```
   npm install
   ```

6. Execute as migrações do banco de dados:
   ```
   php artisan migrate
   ```

7. (Opcional) Se você tiver dados de exemplo, pode executar os seeders:
   ```
   php artisan db:seed
   ```

8. Compile os assets do frontend:
   ```
   npm run dev
   ```

9. Inicie o servidor de desenvolvimento:
   ```
   php artisan serve
   ```

Agora você pode acessar o projeto em `http://localhost:8000`.
