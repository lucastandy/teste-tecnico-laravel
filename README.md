# Sistema de Gerenciamento de Vendas

## Requisitos
* Docker;
* WSL2 (executar o projeto preferencialmente dentro do ambiente WSL)
* Node.js 20 ou superior;
* Git

## Tecnlogias ou recursos utilizados:
* Docker;
* PHP 8.3;
* Laravel 11;
* Eloquent/ORM;
* Javascript;
* PostgreSQL e PGAdmin;
* GIT;
* GITHUB;
* VSCode;
* Mailtrap;
* Vite;
* BootStrap;
* Font Awesome;
* SoftDeletes;

## Principais pacotes utilizados:
* Laravel Beezer;
* Sweetalert2;
* laravel-pt-BR-localization


## Passo a passo para iniciar o projeto

Clonar o repositório
```
git clone ........
```

Acessar diretório do projeto
```
cd teste_pratico
```

Subir os containers do projeto
```
docker-compose up -d
```

Criar o arquivo .env (utilize o arquivo .env.example)
```
cp .env.example .env
```

Adicioanar as credenciais do banco de dados no arquivo .env
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=NOME_DO_BANCO_DE_DADOS
DB_USERNAME=postgres
DB_PASSWORD=SUASENHA
```

Adicioanar as credenciais do Mailtrap no arquivo .env
link do mailtrap: https://mailtrap.io/
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=CRIAR_SEU_USUARIO
MAIL_PASSWORD=CRIAR_SEU_SENHA
```

Acessar o container app (é neste container que o projeto se encontra)
```
docker-compose exec app bash
```

Instalar as dependências do projeto
```
composer install
```

Gerar a key do projeto Laravel
```
php artisan key:generate
```

Rodar as migrations
```
php artisan migrate
```

Rodar as seeders
```
php artisan db:seed
```

Processar os Jobs na fila (Esse comando precisa ser executado para que os Jobs funcionem)
```
php artisan queue:work --queue=default
```

Renderizar o Frontend do sistema (execute fora do container, mas dentro da pasta do projeto)
```
npm run dev
```

## Principais Telas do sistema:

Tela de Login:

![Tela de Login](https://github.com/lucastandy/teste-tecnico-laravel/blob/main/assets/tela_login.png)

Tela Dashboard:

![Tela Dashboard](https://github.com/lucastandy/teste-tecnico-laravel/blob/main/assets/tela_dashboard.png)

Tela Listar Produtos:

![Listar Produtos](https://github.com/lucastandy/teste-tecnico-laravel/blob/main/assets/tela_listar_produtos.png)

Tela Listar Vendas:

![Listar Vendas](https://github.com/lucastandy/teste-tecnico-laravel/blob/main/assets/tela_listar_vendas.png)


## Autor:
Lucas Tandy do Nascimento Silva
 https://www.linkedin.com/in/lucas-tandy/

