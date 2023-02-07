# Crud básico usando docker + Nginx com proxy reverso +  php-fpm

# Tabela cliente

CREATE TABLE cliente( 
    id int(11) AUTO_INCREMENT, 
    nome varchar(30) NOT NULL, 
    idade int(3), 
    email varchar(50), 
    PRIMARY KEY (id) );

# Comando para buildar imagens e criar containers

- docker-compose up -d --build

# Acessar a aplicação
- http://localhost/home.php

# Observação
- A aplicação é extremamente básica, onde é utilzando apenas PHP + HTML. O intuito é mostrar como pode rodar uma aplicação PHP com docker.
- Para uso em produção é necessário tomar politicas de segunça, tanto na aplicação quanto nos arquivos docker e docker-compose.

