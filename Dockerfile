FROM php:8.2-apache

# pastikan cuma 1 MPM
RUN a2dismod mpm_event && a2enmod mpm_prefork

# install ekstensi PHP
RUN docker-php-ext-install pdo pdo_mysql

# enable rewrite (Laravel wajib)
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
