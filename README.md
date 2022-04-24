# gr-plan

A apliaão é via Docker, então como pré-requisito tenha docker na sua máquina com qualquer sistema UNIX ou via WSL

Passo a passo para iniciarlizar aplicação:

# Passso 1:
> git clone

# Passo 1.1 - Copiar arquivo ".env.example" para ".env"
> cp .env.example .env

# Passso2:
> sudo docker-compose up -d --build
# Passso 2.2:
> sudo docker-compose up

# Passo 3: acessar http://localhost:5051/login?next=%2Fbrowser%2F

user:admin@admin.com
senha:root

# Passo 3.1 Vá em "Servers->Create server"(botão direito do mouse) 
General:
Name:postgres

Connecction:
Host name:postgres
port:5432
username:postgres 
Password:postgres 


# Passo 4: 
> docker-compose run --rm composer install
# # Passo 5: 
>  docker-compose run --rm npm install
# Passo 6: 
>  docker-compose run --rm npm run dev
# Passo 7: 
> sudo docker-compose run --rm artisan migrate

# Passo 7:
> docker-compose run --rm artisan db:seed

# Passo 8 
> click:http://localhost:8080/