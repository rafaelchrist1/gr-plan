![GitHub Light](https://github.com/github-light.png#gh-dark-mode-only)
# gr-plan
Objetivo:realizar um CRUD de eletromésticos utilizando Docker+Laravel+vue

Com a apliação é via Docker, existe como pré-requisito docker configurado na sua máquina com qualquer sistema UNIX ou via WSL

Passo a passo para iniciarlizar aplicação:
# Passso 1 - Baixar repo:
> git clone
# Passo 1.1 - Copiar arquivo ".env.example" para ".env"
> cp .env.example .env
# Passso 2 - Compilar container:
> sudo docker-compose up -d --build
# Passso 3 - subir server principal:
> sudo docker-compose up
# Passo 4: 
> docker-compose run --rm composer install
# Passo 5: 
>  docker-compose run --rm npm install
# Passo 6: 
>  docker-compose run --rm npm run dev
# Passo 7: 
> sudo docker-compose run --rm artisan migrate
# Passo 7:
> docker-compose run --rm artisan db:seed
# Passo 8 
> click: http://localhost:8080/

# API DOC SWAGGER
Documentação de API/PRODUTOS, para fins de testes e validação por URL, é só utilizar no link:http://localhost:8080/api/documentation 

![api/documentation](https://github.com/rafaelchrist1/gr-plan/blob/master/public/Api_doc.JPG)

# Testes e validação
![Testes](https://github.com/rafaelchrist1/gr-plan/blob/master/public/Api_doc_testes.JPG)
