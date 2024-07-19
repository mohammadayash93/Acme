FROM php:8.1-cli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /src

COPY . .

RUN composer install