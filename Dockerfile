FROM php:8.2-cli

WORKDIR /app

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

# 1️⃣ install dependency DULU
RUN composer install --no-dev --optimize-autoloader

# 2️⃣ baru bikin .env
RUN cp .env.example .env

# 3️⃣ baru generate key
RUN php artisan key:generate

EXPOSE 80

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]