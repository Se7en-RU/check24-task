FROM php:8.1-fpm-alpine

# Configure file
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

# Install necessary alpine packages
RUN apk update && apk add --no-cache \
    curl \
    zip \
    unzip \
    dos2unix \
    libzip-dev

# Install php extensions
RUN docker-php-ext-install \
            opcache zip pdo pdo_mysql

# Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html