#!/bin/bash
set -e

echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader

echo "Generating application key..."
php artisan key:generate --no-interaction || true

echo "Running migrations..."
php artisan migrate --force --no-interaction || true

echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting application..."
php artisan serve --host 0.0.0.0 --port ${PORT:-8080}
