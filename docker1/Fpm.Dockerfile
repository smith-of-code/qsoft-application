FROM php:8.1-fpm

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

ADD ./php.ini /usr/local/etc/php/php.ini

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /root/.npm/_cacache/tmp

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Create system user to run Composer and Artisan Commands

RUN mkdir -p /var/log/supervisor
RUN mkdir -p /var/log/horizon
# Set working directory
WORKDIR /var/www


# Add user for laravel application
#RUN groupadd -g 1000 www-data
#RUN useradd -u 1000 -ms /bin/bash -g www-data www-data
# Copy existing application directory contents
#COPY . /var/www
# Copy existing application directory permissions
#COPY --chown=www-data:www-data . /var/www
# Change current user to www
#USER www-data

#CMD php-fpm -F -R | supervisord -n

