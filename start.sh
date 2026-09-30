#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

# Générer la clé d'application si absente
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

echo "🧹 Nettoyage des caches..."
php artisan optimize:clear

echo "📦 Migration de la base de données..."
php artisan migrate --force

echo "🌱 Exécution des seeders..."
php artisan db:seed --force

echo "🔗 Lien storage..."
php artisan storage:link || true

echo "✅ Prêt, démarrage du serveur..."

# Démarrer PHP-FPM
exec php-fpm