FROM node:16 AS node
FROM php:8.1-fpm
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node

# Install system dependencies
RUN apt-get update && apt-get install -y \
    wget \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    libzip-dev \
    zip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    supervisor

RUN pecl install xdebug-3.2.0

# Install PHP extensions
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-enable xdebug

COPY ./php.ini /etc/php/8.1/fpm/conf.d/90-php.ini
COPY ./php.ini /etc/php/8.1/cli/conf.d/90-php.ini

RUN usermod -u 1000 www-data

WORKDIR "/var/www"

EXPOSE 9000

