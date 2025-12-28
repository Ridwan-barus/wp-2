FROM php:8.2-cli

WORKDIR /app

# install system deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring bcmath gd

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# BIKIN .env DUMMY UNTUK BUILD
RUN cp .env.example .env

# generate key (INI WAJIB)
RUN php artisan key:generate

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]