#!/bin/bash
set -e

# Wait for database connection if DB_HOST is set
if [ -n "$DB_HOST" ]; then
    echo "Waiting for database connection on $DB_HOST:$DB_PORT..."
    until mysqladmin ping -h"$DB_HOST" -P"${DB_PORT:-3306}" --silent; do
        sleep 1
    done
    echo "Database is up!"
fi

# Run database migrations
echo "Running migrations..."
php artisan migrate --force

# Create storage link if not exists
if [ ! -d "/var/www/public/storage" ]; then
    echo "Creating storage link..."
    php artisan storage:link
fi

# Optimize Laravel caching for production
echo "Caching configuration and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start supervisor
echo "Starting Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
