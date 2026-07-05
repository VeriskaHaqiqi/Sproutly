#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force

# Configure Apache to listen on Railway's PORT
sed -i "s/80/${PORT:-8080}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT:-8080}/g" /etc/apache2/sites-enabled/000-default.conf

echo "Starting Apache..."
exec apache2-foreground