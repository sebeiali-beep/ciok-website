#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# ═══ VIDER TOUS LES CACHES ═══
echo "🧹 Nettoyage des caches..."
php artisan optimize:clear

# ═══ MIGRATIONS ═══
php artisan migrate --force

# ═══ STORAGE LINK ═══
php artisan storage:link || true

# ═══ NE PAS CACHER (config appliquée au runtime) ═══
# Pas de config:cache, route:cache, view:cache

echo "✅ Prêt, démarrage du serveur..."

php-fpm -D
nginx -g "daemon off;"