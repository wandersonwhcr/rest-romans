ARG PHP_VERSION=7.4

FROM php:${PHP_VERSION}-cli-alpine AS builder

ENV COMPOSER_CACHE_DIR /tmp

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apk add unzip

WORKDIR /var/www/html

COPY composer.* /var/www/html/

RUN composer install

COPY . .

RUN composer optimize

FROM php:${PHP_VERSION}-fpm-alpine

COPY --from=builder /var/www/html /var/www/html
