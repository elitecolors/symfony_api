# Dvore - Test technique DevBackend 2022

## Pré-requis
* docker & docker-compose)
* client SGBD pour Postgresql


## Commandes utiles
* Lancement du projet initial : `docker-compose up -d`
* Connexion au container php : `docker-compose exec php sh`


## Connexion à la base de données :

* localhost:8642
* user : postgresql
* passwor : postgresql
* base : postgresql

## postman collection file 
check file TEST_CONS.postman_collection.json

## api url 
http://localhost:8080

## jwt configuration 
after  docker-compose exec php sh
run 

mkdir config/jwt 
chmod -R 777 config/jwt
bin/console lexik:jwt:generate-keypair

## creation a new user 
http://localhost:8080/auth/register
email et password 

## to get token for valid user 
http://localhost:8080/api/login_check

body example

{"username":"test@api.com","password":"123456"}

## import random user from api 
http://localhost:8080/api/randomUser?results=100

## show all user 
http://localhost:8080/api/get

