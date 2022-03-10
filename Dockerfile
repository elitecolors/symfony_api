FROM php:8.0-fpm-alpine

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# https://github.com/docker-library/php/issues/221#issuecomment-209920424
RUN apk update && \
    apk add postgresql-dev && \
    docker-php-ext-install pdo pgsql pdo_pgsql

RUN apk add git yarn

WORKDIR /var/www/test_api

RUN echo 'date.timezone = "Europe/Paris"' > /usr/local/etc/php/conf.d/tzone.ini
RUN echo 'memory_limit = 1024M' > /usr/local/etc/php/conf.d/memory_limit.ini

RUN echo 'log_errors = 1' > /usr/local/etc/php/conf.d/log.ini
RUN echo 'error_log = /var/log/php_error.log' >> /usr/local/etc/php/conf.d/log.ini