#!/bin/bash

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components

# Run migrations and seeders (we use --force because it's in production mode)
php artisan migrate --force
php artisan db:seed --force

# Fix permissions for storage and bootstrap/cache (because running artisan as root might change ownership)
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache in foreground
apache2-foreground
