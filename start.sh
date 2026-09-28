#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Vider TOUS les caches
php artisan optimize:clear

# Migrations
php artisan migrate --force

# Storage link
php artisan storage:link || true

# NE PAS CACHER (les variables Render doivent être lues en runtime)
# Pas de config:cache, route:cache, view:cache

echo "✅ Prêt, démarrage du serveur..."

# Démarrer PHP-FPM
php-fpm -D

# Démarrer Nginx
nginx -g "daemon off;"