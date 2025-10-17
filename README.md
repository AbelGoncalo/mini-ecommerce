# Mini E-commerce


O Mini E-commerce é um projeto desenvolvido como parte de um desafio técnico, com o objetivo de demonstrar competências fullstack utilizando Laravel, Livewire e TailwindCSS.
A aplicação simula uma loja online com listagem de produtos, carrinho, checkout e autenticação de utilizadores.

### BACKEND

- [PHP](https://www.php.net/)
- [LARAVEL](https://laravel.com/)
- [LIVWIRE](https://livewire.org/)
- [MYSQL](https://www.mysql.com/)

### FRONTEND
- [TAILWINDCSS](https://www.php.net/)
- [BOTTSTRAP](https://bootstrap.com/)


## Executando o projeto

Abaixo seguem as instruções para você executar o projeto na sua máquina.

Comece clonando o repositório e instalando suas dependências:

```

git clone <https://git@github.com:AbelGoncalo/mini-ecommerce.git>

cd <mini-ecommerce>

# O gerenciador de pacotes principal é o composer, e sugerimos que utilize o mesmo
composer install

# Env set up
cp .env-example .env

# Laravel APP Key
php artisan key:generate

# set your docker configuration
docker-compose up -d
```

## Fazendo commit

Para fazer um commit, ele deve sempre começar com uma dessas labels para indicar o tipo de mudança, e a mensagem de commit de facto (Capitalizada) depois dos dois pontos.

- **chore**: _refatoração_ Uma mudança que não corrige um bug nem adiciona uma funcionalidade;
- **ci**: Uma mudança relacionada à integração contínua;
- **docs**: Uma mudança ou correção na documentação;
- **feat**: Uma nova funcionalidade;
- **fix**: Uma correção de bug;
- **test**: Uma mudança relacionada a testes.
