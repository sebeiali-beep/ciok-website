#!/bin/bash
set -e

echo "=== Demarrage de CIOK ==="

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

echo "=== Nettoyage des caches ==="
php artisan optimize:clear

echo "=== Migration de la base de donnees ==="
php artisan migrate --force

echo "=== Execution des seeders ==="
php artisan db:seed --force

echo "=== Lien storage ==="
php artisan storage:link || true

echo "=== Pret, demarrage du serveur ==="

exec php-fpm