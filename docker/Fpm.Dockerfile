FROM php:7.4-fpm

RUN apt-get update
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_pgsql
