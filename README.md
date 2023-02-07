# Crud básico usando docker + Nginx com proxy reverso +  php-fpm

# tabela cliente

CREATE TABLE cliente( 
    id int(11) AUTO_INCREMENT, 
    nome varchar(30) NOT NULL, 
    idade int(3), 
    email varchar(50), 
    PRIMARY KEY (id) );

# Comandos

- docker-compose up -d --build

# acessar aplicação
- http://localhost/home.php

