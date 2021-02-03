FROM php:8.0.0-fpm-alpine

RUN apk --update --no-cache add git
RUN set -ex && apk --no-cache add postgresql-dev
RUN docker-php-ext-install pdo_pgsql
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /code
CMD composer install ;  php-fpm
EXPOSE 9000