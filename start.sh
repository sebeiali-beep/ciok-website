#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

php artisan migrate --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

php-fpm -D
nginx -g "daemon off;"