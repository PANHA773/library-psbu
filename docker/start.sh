#!/bin/bash

# Run Laravel setup if .env doesn't exist
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Generate app key only if not already set
if [ -z "$APP_KEY" ]; then
    php /var/www/html/artisan key:generate --no-interaction --force
fi

# Cache config & routes
php /var/www/html/artisan config:cache
php /var/www/html/artisan route:cache

# Run migrations
php /var/www/html/artisan migrate --no-interaction --force

# Start PHP-FPM in background
php-fpm -D

# Start nginx in foreground
nginx -g "daemon off;"
