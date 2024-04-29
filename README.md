Esse projeto é uma mini loja que possui as funcionalidades de login, adicionar produtos em um carrinho, exibir o carrinho e realizar o checkout.

## Tecnologias utilizadas

- PHP v8.1
- Docker
- Banco de Dados: MySQL

## Como testar em sua máquina

- Instale as extensões: `sudo apt-get install -y php8.1-mysql php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath`
- Para baixar as dependências do projeto, execute o comando `composer install`
- Crie um arquivo `.env` e copie as informações do arquivo `.env.example`, alterando os dados de conexão (o STRIPE_KEY é opcional, se desejar fazer o checkout)
- Execute o comando a seguir para subir os containers `docker compose up -d`
- Para descobrir o IP do MySQL execute `docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mini-shop-db-1`
- Para descobrir o IP do phpMyAdmin execute `docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mini-shop-phpmyadmin-1`
- Assim que subir os containers, será criado o banco de dados `mini-shop`. Agora acesse o container do phpmyadmin e utilize o arquivo `scripts.sql` na raíz do projeto para criar as tabelas. 
- Para subir o projeto, execute o comando `php -S localhost:8000 -t public`
- Entre na URL `http://localhost:8000`