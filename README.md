# Projeto de Blog com Laravel e Vue

Este projeto é uma aplicação de blog construída utilizando Laravel como framework backend e Vue.js para o frontend. Ele combina o poder das robustas capacidades de backend do Laravel com a arquitetura reativa e baseada em componentes do Vue para criar uma plataforma de blog moderna e eficiente.

## Características

- API RESTful com Laravel
- Frontend dinâmico com Vue.js

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
