# FROM php:8.2-fpm-alpine
FROM php:8.2-fpm

WORKDIR /var/www/html

COPY src .

# Install required packages
RUN apt-get update && \
    apt-get install -y \
        firebird-dev \
        libmcrypt-dev \
        libssl-dev

# Install PHP extensions
RUN docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_firebird

# RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel # php:8.2-fpm-alpine
# RUN addgroup --gid 1000 laravel && adduser --ingroup laravel --no-create-home --shell /bin/sh --gecos "" --disabled-password laravel

# USER laravel

# RUN chown -R laravel:laravel .
