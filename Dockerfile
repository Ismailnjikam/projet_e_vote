# Build stage
FROM php:8.2-fpm AS builder

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files
COPY composer.json composer.lock* ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application files
COPY . .

# Generate key
RUN php artisan key:generate --no-interaction || true

# Cache config
RUN php artisan config:cache && php artisan route:cache

# Production stage
FROM php:8.2-apache

WORKDIR /app

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists*

RUN docker-php-ext-install pdo pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application from builder
COPY --from=builder /app /app

# Set document root
ENV APACHE_DOCUMENT_ROOT=/app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Add .htaccess for Laravel
COPY .htaccess /app/public/.htaccess

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Create storage directories
RUN mkdir -p /app/storage/logs && chown -R www-data:www-data /app/storage

EXPOSE 80

CMD ["apache2-foreground"]
