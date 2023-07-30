# PHP + Laravel 10

This is a PHP API made whit Laravel Frame work

This is for Exam porpuses, not have to be used to production environments.

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) 

## Customize configuration

## Project Setup

```sh
composer install
```
## Databse Setup
** into your database client
```sh
CREATE DATABASE datanullexamlaraveldev;
```
## env Setup
** in this case i had use Homestead, you have to change to your preference
```sh
DB_CONNECTION=mysql
DB_HOST=192.168.56.56
DB_PORT=3306
DB_DATABASE=datanullexamlaraveldev
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### Migate db

```sh
php artisan migrate
```
## Endpoints

```sh
API url: http://api.nulldataexamlaraveldevl.test/api
```
empleado/create 
```sh
description: to create a new employee
verb: POST
body:{
    "name":"required",
    "email":"required|email",
    "position":"required",
    "birthday":"required|date",
    "skills":[
        {"name":"required","expertice":"required|numeric"}
    ]
}

curl --location 'http://api.nulldataexamlaraveldevl.test/api/empleado/create' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name":"jhon doe",
    "email":"jhon.doe4@email.com",
    "position":"laravel developer",
    "birthday":"10/08/1993",
    "skills":[
        {"name":"Developer","expertice":2},
        {"name":"Backend","expertice":4}
    ]
}'

```

empleado/setAddress
```sh
description: to set address to an created employee
verb: POST
body:'{
    "id":required | if from userid,
     "address":"optional",
     "latitude":"optional",
     "longitude":"optional",
}'

curl --location 'http://api.nulldataexamlaraveldevl.test/api/empleado/setAddress' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "id":1,
     "address":"av siempre viva",
     "latitude":"20.6240244",
     "longitude":"-100.2522286",
}'
```

empleado/read?id= 
```sh
description: to read a employee
verb: GET

curl --location 'http://api.nulldataexamlaraveldevl.test/api/empleado/read?id=1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \

```

empleado/list
```sh
description: to get a list of employee
verb: GET

curl --location 'http://api.nulldataexamlaraveldevl.test/api/empleado/list' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
```

skill/create
```sh
description: to add skill to an created employee
verb: POST
body:'{
    "id":required | id from userid,
    "skills":[
        {"name":"required","expertice":"required|numeric"}
    ]
}'

curl --location 'http://api.nulldataexamlaraveldevl.test/api/skill/create' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "id":1,
    "skills":[
        {"name":"Developer back","expertice":5},
        {"name":"Backend desk","expertice":4}
    ]
}'
```

skill/update
```sh
description: to update an array of skills
verb: PUT
body:'{
    "skills":[
        {"id":required | from skillid,"name":"required","expertice":"required|numeric"}
    ]
}'

curl --location 'http://api.nulldataexamlaraveldevl.test/api/skill/create' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "skills":[
        {"id":1,"name":"Developer back","expertice":2},
        {"id":2,"name":"Backend desk","expertice":4}
    ]
}'
```


