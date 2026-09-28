#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Vider les caches
php artisan optimize:clear

# Migrations
php artisan migrate --force

# Storage link
php artisan storage:link || true

# SEEDER : injecter les données
php artisan db:seed --force || true

echo "✅ Prêt, démarrage du serveur..."

php-fpm -D
nginx -g "daemon off;"