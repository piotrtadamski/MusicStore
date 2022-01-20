ARG PHP_VERSION=7.4

# Dev image
FROM php:${PHP_VERSION}-fpm-alpine AS php-7_4-dev

RUN apk update

## Install php extensions
RUN docker-php-ext-install pdo_mysql

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /app

## Install composer
RUN wget https://getcomposer.org/installer && \
    php installer --install-dir=/usr/local/bin/ --filename=composer && \
    rm installer
