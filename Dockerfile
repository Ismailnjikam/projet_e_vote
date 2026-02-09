# Build stage
FROM php:8.2-fpm AS builder

WORKDIR /app

# Install dependencies système
RUN apt-get update && apt-get install -y \
    git curl zip unzip libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Extensions PHP
RUN docker-php-ext-install pdo pdo_sqlite

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier tout projet AVANT composer
COPY . .

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Générer clé Laravel
RUN php artisan key:generate --force || true

# Cache Laravel
RUN php artisan config:cache || true
RUN php artisan route:cache || true


# Production stage
FROM php:8.2-apache

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_sqlite
RUN a2enmod rewrite

# Copier app buildée
COPY --from=builder /app /app

# Apache config Laravel
ENV APACHE_DOCUMENT_ROOT=/app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Permissions Laravel
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
