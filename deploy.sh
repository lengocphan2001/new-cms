rm -rf vendor
rm app.zip
composer install --optimize-autoloader --no-dev
php artisan config:clear
php artisan cache:clear
php artisan route:clear
zip -r app . -x "/node_modules/*" "composer.lock"