#!/bin/bash
set -e

echo "🚀 Démarrage de CIOK..."

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

php artisan optimize:clear
php artisan migrate --force
php artisan storage:link || true

# ✅ FIX ADMIN : Forcer les droits admin
echo "🔧 Correction des droits admin..."
php artisan tinker --execute="
\$u = App\Models\User::where('email', 'admin@ciok.tn')->first();
if (\$u) {
    \$u->is_admin = true;
    \$u->role = 'super_admin';
    \$u->save();
    echo 'Admin corrigé : ' . \$u->email;
} else {
    echo 'Admin non trouvé';
}
" || true

echo "✅ Prêt, démarrage du serveur..."

php-fpm -D
nginx -g "daemon off;"