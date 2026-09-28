#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Vider les caches
php artisan optimize:clear

# Migrations (SANS fresh)
php artisan migrate --force

# Storage link
php artisan storage:link || true

# Seeder UNIQUEMENT les appels d'offres
echo "🌱 Seeding tenders only..."
php artisan db:seed --class=TenderSeeder --force || true

echo "✅ Prêt, démarrage du serveur..."

php-fpm -D
nginx -g "daemon off;"