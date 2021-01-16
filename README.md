# Systme-education-parentale

readme.md

Build Status Total Downloads Latest Stable Version License
About Laravel-api
Table of Contents

    Installation
    Routes
        Apientication
        Password Reset

Installation

    Clone repository

$ git clone https://github.com/santoshnet/laravel-api.git

    Enter folder

$ cd laravel-api

    Install composer dependencies

~/laravel-api$ composer install

    Generate APP_KEY

~/laravel-api$ php artisan key:generate

    Configure .env file, edit file with next command $ nano .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=user
DB_PASSWORD=secret

MAIL_DRIVER=smtp MAIL_HOST=smtp.gmail.com MAIL_PORT=587 MAIL_USERNAME=mymail@gmail.com MAIL_PASSWORD=secret MAIL_ENCRYPTION=TLS

    Run migrations

~/laravel-api$ php artisan migrate

    Create client

~/laravel-api$ php artisan passport:install

Routes
Apientication

    POST /Api/login
    GET /Api/logout
    POST /Api/register
    GET /Api/register/activate/{token}
    GET /Api/user_details

Password Reset

    POST /password/create
    GET /password/find/{token}
    POST /password/reset

Blog Api

    POST /blog/
    GET /blogs/
    POST /blogs/{id}
    GET /blogs/{id}
    DELETE /blogs/{id}
