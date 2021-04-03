ARG PHP_VERSION=7.4

FROM php:${PHP_VERSION}-fpm-alpine

ENV COMPOSER_CACHE_DIR /tmp

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apk add unzip
