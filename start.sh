#!/bin/bash

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components

# Run migrations (we use --force because it's in production mode)
php artisan migrate --force

# Start Apache in foreground
apache2-foreground
