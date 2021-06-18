FROM php:7.2-fpm
RUN apt-get update  && apt-get install -y \
    git \
    unzip\
    vim \
    zip \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-install pdo_mysql mysqli mbstring gd iconv sockets
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html