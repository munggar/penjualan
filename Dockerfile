FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

WORKDIR /var/www/html

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chmod -R 755 storage && chmod -R 755 bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
