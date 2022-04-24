# gr-plan
Objetivo:realizar um CRUD de eletroomésticos utilizando Docker+Laravel+vue

Com a apliação é via Docker, existe como pré-requisito docker configurado na sua máquina com qualquer sistema UNIX ou via WSL

Passo a passo para iniciarlizar aplicação:
# Passso 1:
> git clone
# Passo 1.1 - Copiar arquivo ".env.example" para ".env"
> cp .env.example .env
# Passso2:
> sudo docker-compose up -d --build
# Passso 3:
> sudo docker-compose up
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