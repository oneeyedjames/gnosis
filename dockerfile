FROM php:fpm

WORKDIR /var/www

RUN mkdir /var/www/data

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update \
&& apt-get install -y libmemcached-dev zlib1g-dev

RUN pecl install memcached xdebug \
&& docker-php-ext-enable memcached xdebug
