#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

php artisan optimize:clear

# ⚠️ RECRÉER LES TABLES (dernier recours)
php artisan migrate:fresh --force

php artisan storage:link || true

php artisan db:seed --force || true

echo "✅ Prêt, démarrage du serveur..."

php-fpm -D
nginx -g "daemon off;"